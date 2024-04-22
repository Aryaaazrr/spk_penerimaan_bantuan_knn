<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kriteria = Kriteria::all();

        if ($request->ajax()) {
            return DataTables::of($kriteria)
                ->addColumn('DT_RowIndex', function ($kriteria) {
                    return $kriteria->id_kriteria;
                })
                ->toJson();
        }

        return view('pages.kriteria.index');
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
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $kriteria = new Kriteria();
        $kriteria->nama = $request->nama;
        $kriteria->keterangan = $request->keterangan;
        $kriteria->save();

        return redirect()->route('kriteria')->with('success', 'Data kriteria berhasil ditambahkan.');
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
        $id = $request->id_kriteria;
        $kriteria = Kriteria::find($id);

        if (!$kriteria) {
            return back()->withErrors(['error' => 'Kriteria tidak ditemukan. Silahkan coba kembali']);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $kriteria->nama = $request->nama;
        $kriteria->keterangan = $request->keterangan;

        if ($kriteria->save()) {
            return redirect()->route('kriteria')->with('success', 'Data Kriteria berhasil diperbarui.');
        } else {
            return back()->withErrors(['error' => 'Gagal menyimpan data. Silahkan coba kembali.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kriteria = Kriteria::find($id);

        if (!$kriteria) {
            return back()->with(['error' => 'Kriteria tidak ditemukan']);
        }

        $kriteria->delete();
        return redirect()->route('kriteria')->with(['success' => 'Kriteria berhasil dihapus']);
    }
}