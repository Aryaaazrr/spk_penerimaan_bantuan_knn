<?php

namespace App\Http\Controllers;

use App\Models\DetailKriteria;
use App\Models\Kriteria;
use App\Models\Training;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AnalisaController extends Controller
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
        return view('pages.analisa.index', ['kriteria' => $kriteria, 'detailKriteria' => $detailKriteria]);
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
        //
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