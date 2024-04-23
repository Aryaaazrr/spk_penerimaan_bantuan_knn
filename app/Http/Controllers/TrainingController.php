<?php

namespace App\Http\Controllers;

use App\Models\DetailKriteria;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $training = Training::all();
        $usia = DetailKriteria::where('kriteria', 'Usia')->get();
        $pekerjaan = DetailKriteria::where('kriteria', 'Pekerjaan')->get();
        $gaji = DetailKriteria::where('kriteria', 'Gaji')->get();
        $tanggungan = DetailKriteria::where('kriteria', 'Tanggungan')->get();
        $statusRumah = DetailKriteria::where('kriteria', 'Status Rumah')->get();

        if ($request->ajax()) {
            return DataTables::of($training)
                ->addColumn('DT_RowIndex', function ($training) {
                    return $training->id;
                })
                ->toJson();
        }

        return view('pages.training.index', ['usia' => $usia, 'pekerjaan' => $pekerjaan, 'gaji' => $gaji, 'tanggungan' => $tanggungan, 'status_rumah' => $statusRumah]);
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
            'nama' => 'required',
            'usia' => 'required',
            'pekerjaan' => 'required',
            'gaji' => 'required',
            'tanggungan' => 'required',
            'status_rumah' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $detail = new Training();
        $detail->nama = $request->nama;
        $detail->usia = $request->usia;
        $detail->pekerjaan = $request->pekerjaan;
        $detail->gaji = $request->gaji;
        $detail->tanggungan = $request->tanggungan;
        $detail->status_rumah = $request->status_rumah;
        $detail->save();

        return redirect()->route('training')->with('success', 'Data training berhasil ditambahkan.');
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
