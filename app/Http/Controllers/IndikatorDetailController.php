<?php

namespace App\Http\Controllers;

use App\Models\BidangModel;
use App\Models\IndikatorModel;
use App\Models\IndikatorDetailModel;
use Illuminate\Http\Request;


class IndikatorDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // return User::with('bidang')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(IndikatorModel $indikator)
    {
        $bidang = BidangModel::all();
        return view('indikatordetail.create', compact('indikator', 'bidang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kegiatanname'              => 'required',
            'usulankegiatanname'        => 'required',
            'usulankegiatanrealisasi'   => 'required',
            'targetper'                 => 'required',
            'targetperjenis'            => 'required',
            'keterangan'                => 'required',
            'triwulan'                  => 'required',
            'realisasianggaran'         => 'required',
            'bidang'                    => 'required',
        ]);

        IndikatorDetailModel::create([
            'indikator_id'              => $request->id,
            'kegiatan_name'             => $request->kegiatanname,
            'usulan_kegiatan_name'      => $request->usulankegiatanname,
            'realisasi_kegiatan_name'   => $request->usulankegiatanrealisasi,
            'target_per'                => $request->targetper,
            'target_per_jenis'          => $request->targetperjenis,
            'keterangan'                => $request->keterangan,
            'triwulan'                  => $request->triwulan,
            'realisasi_anggaran'        => $request->realisasianggaran,
            'bidang_id'                 => $request->bidang,
        ]);
        return redirect()->route('indikator.index')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(IndikatorDetailModel $indikatorDetailModel)
    // {
    //     // $bidang = BidangModel::all();
    //     return view('indikatordetail.show', ['indikatorDetailModel' => $indikatorDetailModel]);
    //     // echo "test";
    // }

    public function show($id)
    {
        $indikatorDetailModel = IndikatorDetailModel::findOrFail($id);
        // $bidang = BidangModel::all();
        return view('indikatordetail.show', ['indikatorDetailModel' => $indikatorDetailModel]);
        // echo "test";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IndikatorDetailModel $indikatorDetailModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IndikatorDetailModel $indikatorDetailModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IndikatorDetailModel $indikatorDetailModel)
    {
        //
    }
}
