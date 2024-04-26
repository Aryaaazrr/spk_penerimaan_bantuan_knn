<?php

namespace App\Http\Controllers;

use App\Models\DetailKriteria;
use App\Models\DetailPenduduk;
use App\Models\Kriteria;
use App\Models\Penduduk;
use App\Models\Testing;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AnalisaController extends Controller
{
    public function calculateEncludeanDistance($testing, $trainingData)
    {
        $encludeanDistances = [];

        foreach ($trainingData as $training) {
            $distance = $this->calculateDistance($testing, $training);
            $encludeanDistances[] = [
                'data' => $training,
                'distance' => $distance
            ];
        }

        usort($encludeanDistances, function ($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });

        return $encludeanDistances;
    }

    public function calculateDistance($testing, $training)
    {
        $distance = $this->euclideanDistance($testing, $training);

        return $distance;
    }

    public function euclideanDistance($testing, $training)
    {
        $testingDetailPenduduk = $testing->penduduk->detail_penduduk;
        $trainingDetailPenduduk = $training->penduduk->detail_penduduk;
        $totalSquaredDifference = 0;

        foreach ($testingDetailPenduduk as $testingDetail) {
            $testingSubkriteriaId = $testingDetail->id_subkriteria;
            $testingSubkriteriaValue = $testingDetail->detail_kriteria->nilai;

            foreach ($trainingDetailPenduduk as $trainingDetail) {
                if ($testingDetail->id_kriteria == $trainingDetail->id_kriteria) {
                    $trainingSubkriteriaValue = $trainingDetail->detail_kriteria->nilai;

                    $difference = $testingSubkriteriaValue - $trainingSubkriteriaValue;
                    $squaredDifference = $difference * $difference;
                    $totalSquaredDifference += $squaredDifference;
                }
            }
        }

        $euclideanDistance = sqrt($totalSquaredDifference);

        return $euclideanDistance;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kriteria = Kriteria::all();
        $detailKriteria = DetailKriteria::all();
        $kesimpulan = $request->session()->get('kesimpulan');
        
        if ($request->ajax()) {
            $testingId = $request->session()->get('latest_testing_id');
            $testing = Testing::with('penduduk')->find($testingId);

            if ($testing) {
                $rowData = [];
                $penduduk = $testing->penduduk;
                $detailPenduduk = $penduduk->detail_penduduk;
                $subkriteriaData = [];

                foreach ($detailPenduduk as $detail) {
                    $kriteria = Kriteria::find($detail->id_kriteria);
                    $subkriteria = DetailKriteria::find($detail->id_subkriteria);

                    if ($kriteria && $subkriteria) {
                        $subkriteriaData[$kriteria->nama] = $subkriteria->nilai;
                    }
                }

                $rowData[] = [
                    'DT_RowIndex' => $testing->id_testing,
                    'id_penduduk' => $penduduk->id_penduduk,
                    'rt_rw' => $penduduk->rt_rw,
                    'nik' => $penduduk->nik,
                    'nama' => $penduduk->nama,
                    'subkriteria' => $subkriteriaData,
                    'keputusan' => $testing->keputusan,
                ];

                return DataTables::of($rowData)->toJson();
            } else {
                return response()->json([]);
            }
        }

        return view('pages.analisa.index', ['kriteria' => $kriteria, 'detailKriteria' => $detailKriteria, 'kesimpulan' => $kesimpulan]);
    }

    public function klasifikasi(Request $request)
    {
        $testingId = $request->session()->get('latest_testing_id');
        $testing = Testing::with('penduduk')->find($testingId);

        if ($testing) {
            $kesimpulanLayak = Training::where('pilihan', 'Ya')->where('keputusan', 'Layak')->count();
            $kesimpulanTidakLayak = Training::where('pilihan', 'Ya')->where('keputusan', 'Tidak Layak')->count();
            if ($kesimpulanLayak > $kesimpulanTidakLayak) {
                $kesimpulan = 'Layak';
                $testing->keputusan = $kesimpulan;
                $testing->save();
                $request->session()->put('kesimpulan', $kesimpulan);
            } else {
                $kesimpulan = 'Tidak Layak';
                $testing->keputusan = $kesimpulan;
                $testing->save();
                $request->session()->put('kesimpulan', $kesimpulan);
            }
            $training = Training::with('penduduk')->get();
            $rowData = [];

            foreach ($training as $row) {
                $penduduk = $row->penduduk;

                $rowData[] = [
                    'DT_RowIndex' => $row->id_training,
                    'id_penduduk' => $penduduk->id_penduduk,
                    'rt_rw' => $penduduk->rt_rw,
                    'nik' => $penduduk->nik,
                    'nama' => $penduduk->nama,
                    'distance' => $row->distance,
                    'rangking' => $row->rangking,
                    'pilihan' => $row->pilihan,
                    'keputusan' => $row->keputusan,
                ];
            }

            return DataTables::of($rowData)->toJson();
        } else {
            return response()->json([]);
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rt' => 'required',
            'nik' => 'required|digits:16|unique:penduduk',
            'nama' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $jumlahDataKriteria = Kriteria::count();
            $jumlahDataTraining = Training::count();

            if ($jumlahDataKriteria == 0) {
                throw new \Exception('Data kriteria masih kosong. Silahkan isi terlebih dahulu.');
            }

            if ($jumlahDataTraining == 0) {
                throw new \Exception('Data training masih kosong. Silahkan isi terlebih dahulu.');
            }

            DB::beginTransaction();

            $penduduk = new Penduduk();
            $penduduk->rt_rw = $request->rt;
            $penduduk->nik = $request->nik;
            $penduduk->nama = $request->nama;

            if ($penduduk->save()) {
                foreach ($request->all() as $key => $value) {
                    if (strpos($key, '_kriteria') !== false) {
                        $kriteriaNama = str_replace('_', ' ', preg_replace("/_kriteria$/", "", $key));
                        $kriteria = Kriteria::where('nama', $kriteriaNama)->first();
                        if ($kriteria) {
                            $kriteriaId = $kriteria->id_kriteria;
                            $subkriteriaId = $value;

                            $detailPenduduk = new DetailPenduduk();
                            $detailPenduduk->id_penduduk = $penduduk->id_penduduk;
                            $detailPenduduk->id_kriteria = $kriteriaId;
                            $detailPenduduk->id_subkriteria = $subkriteriaId;
                            if (!$detailPenduduk->save()) {
                                throw new \Exception('Gagal menyimpan detail penduduk.');
                            }
                        } else {
                            throw new \Exception('Kriteria tidak ditemukan. Silahkan coba kembali.');
                        }
                    }
                }
            } else {
                throw new \Exception('Gagal menyimpan data penduduk. Silahkan coba kembali.');
            }

            $testing = new Testing();
            $testing->id_penduduk = $penduduk->id_penduduk;

            if (!$testing->save()) {
                throw new \Exception('Gagal menyimpan data penduduk. Silahkan coba kembali.');
            }
            $request->session()->put('latest_testing_id', $testing->id_testing);

            DB::commit();

            return redirect()->route('analisa')->with('success', 'Data testing berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $testingId = $request->session()->get('latest_testing_id');
        $testing = Testing::with('penduduk')->find($testingId);

        if ($testing) {
            $trainingData = Training::with('penduduk')->get();
            $rowData = [];

            foreach ($trainingData as $row) {
                $penduduk = $row->penduduk;
                $detailPendudukTesting = $testing->penduduk->detail_penduduk;
                $detailPendudukTraining = $row->penduduk->detail_penduduk;
                $squaredDifferences = [];
                $subkriteriaData = [];

                foreach ($detailPendudukTesting as $testingDetail) {
                    $testingSubkriteriaId = $testingDetail->id_subkriteria;
                    $testingSubkriteriaValue = $testingDetail->detail_kriteria->nilai;

                    foreach ($detailPendudukTraining as $trainingDetail) {
                        if ($testingDetail->id_kriteria == $trainingDetail->id_kriteria) {
                            $trainingSubkriteriaValue = $trainingDetail->detail_kriteria->nilai;

                            $difference = pow($testingSubkriteriaValue - $trainingSubkriteriaValue, 2);
                            $squaredDifferences[] = $difference;

                            $kriteria = Kriteria::find($trainingDetail->id_kriteria);
                            $subkriteria = DetailKriteria::find($trainingDetail->id_subkriteria);

                            if ($kriteria && $subkriteria) {
                                $subkriteriaData[$kriteria->nama] = $difference;
                            }
                        }
                    }
                }

                $euclideanDistance = sqrt(array_sum($squaredDifferences));

                $trainingEntry = Training::find($row->id_training);
                $trainingEntry->distance = number_format($euclideanDistance, 2);
                $trainingEntry->save();

                $sortedTrainingData = $trainingData->sortBy('distance');

                $rank = 1;
                foreach ($sortedTrainingData as $row) {
                    $trainingEntry = Training::find($row->id_training);
                    $trainingEntry->rangking = $rank;

                    if ($rank <= 3) {
                        $trainingEntry->pilihan = 'Ya';
                    } else {
                        $trainingEntry->pilihan = 'Tidak';
                    }

                    $trainingEntry->save();
                    $rank++;
                }

                $rowData[] = [
                    'DT_RowIndex' => $row->id_training,
                    'id_penduduk' => $penduduk->id_penduduk,
                    'rt_rw' => $penduduk->rt_rw,
                    'nik' => $penduduk->nik,
                    'nama' => $penduduk->nama,
                    'subkriteria' => $subkriteriaData,
                    'distance' => number_format($euclideanDistance, 2),
                ];
            }

            return DataTables::of($rowData)->toJson();
        } else {
            return response()->json([]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}