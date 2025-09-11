<?php

namespace App\Http\Controllers;

use App\Models\IndikatorDetailModel;
use App\Models\IndikatorModel;
use App\Models\PenilaianModel;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $penilaian = IndikatorModel::where('')->get();

        return view("penilaian.index", compact('penilaian'));

        // foreach ($penilaian as $detail) {
        //     echo $detail->usulan_kegiatan_name . ' = ' . $detail->penilaian_sum_realisasi_kegiatan_score . '<br>';
        // }
    }

    public function detail($id)
    {
        $penilaian = IndikatorDetailModel::withSum('penilaian', 'realisasi_kegiatan_score')
            ->where('indikator_id', $id)
            ->get(['id', 'usulan_kegiatan_name']);

        return view("penilaian.detail", compact('penilaian'));

        // foreach ($penilaian as $detail) {
        //     echo $detail->usulan_kegiatan_name . ' = ' . $detail->penilaian_sum_realisasi_kegiatan_score . '<br>';
        // }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $indikatordetail = IndikatorDetailModel::with('indikator')->findOrFail($id);
        return view("penilaian.create", compact('indikatordetail'));
        // dd($indikatordetail);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'indikatordetailid'         => 'required',
            'indikatorid'               => 'required',
            'usulankegiatanscore'       => 'required',
            'realisasikegiatanscore'    => 'required',
            'month'                     => 'required',
            'year'                      => 'required',
            'keterangan'                => 'required',
            'suppportingdata'           => 'required',
        ]);

        PenilaianModel::create([
            'indikator_id'              => decrypt($request->indikatorid),
            'indikator_detail_id'       => $request->indikatordetailid,
            'usulan_kegiatan_score'     => $request->usulankegiatanscore,
            'realisasi_kegiatan_score'  => $request->realisasikegiatanscore,
            'month'                     => $request->month,
            'year'                      => $request->year,
            'keterangan'                => $request->keterangan,
            'suppporting_data'          => $request->suppportingdata,

        ]);
        return redirect()->route('indikator.index')->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(PenilaianModel $penilaianModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenilaianModel $penilaianModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenilaianModel $penilaianModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PenilaianModel $penilaianModel)
    {
        //
    }
}
