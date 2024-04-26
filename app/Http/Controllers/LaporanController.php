<?php

namespace App\Http\Controllers;

use App\Models\Testing;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $testing = Testing::with('penduduk')->get();

        if ($request->ajax()) {
            return DataTables::of($testing)
                ->addColumn('DT_RowIndex', function ($testing) {
                    return $testing->id_testingt;
                })
                ->addColumn('rt_rw', function ($testing) {
                    return $testing->penduduk->rt_rw;
                })
                ->addColumn('nik', function ($testing) {
                    return $testing->penduduk->nik;
                })
                ->addColumn('nama', function ($testing) {
                    return $testing->penduduk->nama;
                })
                ->toJson();
        }

        return view('pages.laporan.index');
    }

    public function printReport()
    {
        $testing = Testing::with('penduduk')->get();
        $html = view('pages.laporan.report', compact('testing'))->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream('laporan_penerimaan_bantuan.pdf');
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