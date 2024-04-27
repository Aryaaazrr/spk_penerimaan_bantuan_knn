<?php

namespace App\Http\Controllers;

use App\Models\DetailKriteria;
use App\Models\DetailPenduduk;
use App\Models\Kriteria;
use App\Models\Penduduk;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kriteria = Kriteria::all();
        $detailKriteria = DetailKriteria::all();

        if ($request->ajax()) {
            $training = Training::with('penduduk')->get();

            $rowData = [];
            foreach ($training as $row) {
                $penduduk = $row->penduduk;
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
                    'DT_RowIndex' => $row->id_training,
                    'id_penduduk' => $penduduk->id_penduduk,
                    'rt_rw' => $penduduk->rt_rw,
                    'nik' => $penduduk->nik,
                    'nama' => $penduduk->nama,
                    'subkriteria' => $subkriteriaData,
                    'keputusan' => $row->keputusan,
                ];
            }

            return DataTables::of($rowData)->toJson();
        }

        return view('pages.training.index', ['kriteria' => $kriteria, 'detailKriteria' => $detailKriteria]);
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
            'keputusan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $jumlahDataKriteria = Kriteria::count();

            if ($jumlahDataKriteria == 0) {
                throw new \Exception('Data kriteria masih kosong. Silahkan isi terlebih dahulu.');
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

            $training = new Training();
            $training->id_penduduk = $penduduk->id_penduduk;
            $training->keputusan = $request->keputusan;

            if (!$training->save()) {
                throw new \Exception('Gagal menyimpan data penduduk. Silahkan coba kembali.');
            }

            DB::commit();

            return redirect()->route('training')->with('success', 'Data training berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rt' => 'required',
            'nik' => 'required|digits:16',
            'nama' => 'required',
            'keputusan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $training = Training::find($request->id_training);

            if ($training == null) {
                throw new \Exception('Data training tidak ditemukan. Silahkan coba kembali.');
            }

            DB::beginTransaction();

            $penduduk = Penduduk::where('nik', $request->nik)->first();
            $penduduk->rt_rw = $request->rt;
            $penduduk->nik = $request->nik;
            $penduduk->nama = $request->nama;

            if ($penduduk->save()) {
                $detailPenduduk = DetailPenduduk::where('id_penduduk', $penduduk->id_penduduk)->get();
                foreach ($detailPenduduk as $item) {
                    $item->delete();
                }
                // dd($detailPenduduk);
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

            $training->keputusan = $request->keputusan;

            if (!$training->save()) {
                throw new \Exception('Gagal menyimpan data penduduk. Silahkan coba kembali.');
            }

            DB::commit();

            return redirect()->route('training')->with('success', 'Data training berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $training = Training::find($id);
            $penduduk = Penduduk::where('id_penduduk', $training->id_penduduk)->first();
            $penduduk->delete();
            return response()->json(['message' => 'Data training berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus data'], 500);
        }
    }
}