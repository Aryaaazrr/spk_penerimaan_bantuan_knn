<?php

namespace App\Http\Controllers;

use App\Models\DetailKriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kriteria = Kriteria::all();
        $detail_kriteria = DetailKriteria::all();

        if ($request->ajax()) {
            return DataTables::of($detail_kriteria)
                ->addColumn('DT_RowIndex', function ($detail_kriteria) {
                    return $detail_kriteria->id_kriteria;
                })
                ->toJson();
        }

        return view('pages.kriteria.subkriteria.index', ['kriteria' => $kriteria]);
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
            'subkriteria' => 'required',
            'kriteria' => 'required',
            'nilai' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $kriteria = Kriteria::find($request->kriteria);
        $nama = $kriteria->nama;

        $detail = new DetailKriteria();
        $detail->id_kriteria = $request->kriteria;
        $detail->subkriteria = $request->subkriteria;
        $detail->kriteria = $nama;
        $detail->nilai = $request->nilai;
        $detail->save();

        return redirect()->route('subkriteria')->with('success', 'Data subkriteria berhasil ditambahkan.');
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
        $id = $request->kriteria;
        $kriteria = Kriteria::find($id);

        if (!$kriteria) {
            return back()->withErrors(['error' => 'Kriteria tidak ditemukan. Silahkan coba kembali']);
        }

        $validator = Validator::make($request->all(), [
            'subkriteria' => 'required',
            'kriteria' => 'required',
            'nilai' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $kriteria = Kriteria::find($request->kriteria);
        $nama = $kriteria->nama;

        $detail = DetailKriteria::where('id_subkriteria', $request->id_subkriteria)->first();
        $detail->id_kriteria = $request->kriteria;
        $detail->subkriteria = $request->subkriteria;
        $detail->kriteria = $nama;
        $detail->nilai = $request->nilai;
        $detail->save();

        return redirect()->route('subkriteria')->with('success', 'Data subkriteria berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $kriteria = DetailKriteria::find($id);
            $kriteria->delete();
            return response()->json(['message' => 'Data subkriteria berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus data'], 500);
        }
    }
}