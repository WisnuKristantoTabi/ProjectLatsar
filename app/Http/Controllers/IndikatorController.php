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
        $indikator = IndikatorModel::all();
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
            'paguanggaran'          => 'required',
            'koreksinormalisasi'    => 'required',
        ]);

        IndikatorModel::create([
            'sasaran'                   => $request->sasaran,
            'indikator_kinerja'         => $request->indikatorkinerja,
            'target'                    => $request->target,
            'target_jenis'              => $request->target_jenis,
            'pagu_anggaran'             => $request->paguanggaran,
            'koreksi_normalisasi'       => $request->koreksinormalisasi,
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IndikatorModel $indikatorModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IndikatorModel $indikatorModel)
    {
        //
    }
}
