<?php

namespace App\Http\Controllers;

use App\Models\IndikatorModel;
use App\Models\IndikatorDetailModel;
use App\Models\BidangModel;
use Illuminate\Http\Request;

class IndikatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $indikator = IndikatorModel::where('tahun', "2026")->get();;
        return view('indikator.index', compact('indikator'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bidang = BidangModel::all();
        return view('indikator.create', compact('bidang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sasaran'               => 'required',
            'indikatorkinerja'      => 'required',
            'target'                => 'required',
            'target_jenis'          => 'required',
            'bidang'                => 'required',
            'paguanggaran'          => 'required',
            'koreksinormalisasi'    => 'required',
            'tahun'                 => 'required',
        ]);

        IndikatorModel::create([
            'sasaran'                   => $request->sasaran,
            'indikator_kinerja'         => $request->indikatorkinerja,
            'target'                    => $request->target,
            'target_jenis'              => $request->target_jenis,
            'pagu_anggaran'             => $request->paguanggaran,
            'bidang_id'                 => $request->bidang,
            'koreksi_normalisasi'       => $request->koreksinormalisasi,
            'tahun'                     => $request->tahun,
        ]);
        return redirect()->route('indikator.index')->with('success', 'Indikator berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(IndikatorModel $indikatorModel)
    {

        $indikatordetail = IndikatorDetailModel::where('indikator_id', $indikatorModel->indikator_id)->get();
        return view('indikator.show', compact('indikatorModel', 'indikatordetail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IndikatorModel $indikatorModel)
    {
        $bidang = BidangModel::all();
        return view('indikator.edit', compact(['indikatorModel', 'bidang']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IndikatorModel $indikatorModel)
    {
        $request->validate([
            'sasaran'               => 'required',
            'indikatorkinerja'      => 'required',
            'target'                => 'required',
            'target_jenis'          => 'required',
            'paguanggaran'          => 'required',
            'bidang'                => 'required',
            'koreksinormalisasi'    => 'required',
            'tahun'                 => 'required',
        ]);

        $indikatorModel->update([
            'sasaran'                   => $request->sasaran,
            'indikator_kinerja'         => $request->indikatorkinerja,
            'target'                    => $request->target,
            'target_jenis'              => $request->target_jenis,
            'pagu_anggaran'             => $request->paguanggaran,
            'bidang_id'                 => $request->bidang,
            'koreksi_normalisasi'       => $request->koreksinormalisasi,
            'tahun'                     => $request->tahun,
        ]);
        return redirect()->route('indikator.index')->with('success', 'Indikator berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IndikatorModel $indikatorModel)
    {
        $indikatorModel->penilaian()->delete();
        $indikatorModel->indikatorDetail()->delete();
        $indikatorModel->delete();
        return redirect()->route('indikator.index')->with('success', 'Data berhasil di hapus!');
    }
}
