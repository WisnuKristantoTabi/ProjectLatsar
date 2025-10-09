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
    public function index()
    {
        // $penilaian = IndikatorModel::with(['bidang', 'indikator'])
        //     ->withSum('penilaian', 'realisasi_kegiatan_score')
        //     ->where('bidang_id', session('bidang'))
        //     ->get();
        $penilaian = IndikatorModel::where('bidang_id', session('bidang'))
            // ->withSum('penilaian', 'realisasi_kegiatan_score')
            ->get();
        return view("penilaian.index", compact('penilaian'));
        // foreach ($penilaian as $detail) {
        //     echo $detail->usulan_kegiatan_name . ' = ' . $detail->penilaian_sum_realisasi_kegiatan_score . '<br>';
        // }
        // dd([
        //     'session_bidang' => session('bidang'),
        //     'all_bidang_id' => IndikatorDetailModel::pluck('bidang_id')->unique()
        // ]);
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

    public function data($id)
    {
        $penilaian = PenilaianModel::with("indikatorDetail")
            ->where("indikator_detail_id", $id)
            ->get();

        // print_r($penilaian);
        return view("penilaian.data", compact('penilaian'));
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
            'realisasikegiatanscore'    => 'required',
            'month'                     => 'required',
            'year'                      => 'required',
            'keterangan'                => 'required',
            'suppportingdata'           => 'required',
        ]);

        PenilaianModel::create([
            'indikator_id'              => decrypt($request->indikatorid),
            'indikator_detail_id'       => $request->indikatordetailid,
            'realisasi_kegiatan_score'  => $request->realisasikegiatanscore,
            'month'                     => $request->month,
            'year'                      => $request->year,
            'keterangan'                => $request->keterangan,
            'suppporting_data'          => $request->suppportingdata,

        ]);
        return redirect()->route('penilaian.data', $request->indikatordetailid)->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // print($id);
        $penilaian = PenilaianModel::with(['indikator', 'indikatorDetail'])->findOrFail($id);
        return view("penilaian.show", compact('penilaian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $penilaian = PenilaianModel::with(['indikator', 'indikatorDetail'])->findOrFail($id);
        return view("penilaian.edit", compact('penilaian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'realisasikegiatanscore'    => 'required',
            'month'                     => 'required',
            'year'                      => 'required',
            'keterangan'                => 'required',
            'suppportingdata'           => 'required',
        ]);

        $penilaianModel =  PenilaianModel::findOrFail($request->idpenilaian);

        $penilaianModel->update([
            'realisasi_kegiatan_score'  => $request->realisasikegiatanscore,
            'month'                     => $request->month,
            'year'                      => $request->year,
            'keterangan'                => $request->keterangan,
            'suppporting_data'          => $request->suppportingdata,

        ]);
        // dd($request);
        // print($request->idpenilaian);
        return redirect()->route('penilaian.data', $request->id)->with('success', 'Kegiatan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $penilaianModel = PenilaianModel::findOrFail($id);
        $penilaianModel->delete();
        return redirect()->route('penilaian.data', $penilaianModel->indikator_detail_id)->with('success', 'Data berhasil di hapus!');
    }
}
