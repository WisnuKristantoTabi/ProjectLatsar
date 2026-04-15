<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\IndikatorModel;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        //  (SUM(realisasi_kegiatan_score) / SUM(usulan_kegiatan_score) )* 100 AS score,
        //    ((SUM(realisasi_kegiatan_score) / SUM(usulan_kegiatan_score)) * 100) / SUM(d.target_per) AS test
        $laporan = DB::select("SELECT
            b.nama_bidang,
            AVG(sub.capaian_akhir) AS rata_rata_capaian
        FROM (
            SELECT
                i.bidang_id,
                idt.indikator_detail_id,
                -- Hitung capaian awal dalam persen
                (SUM(p.realisasi_kegiatan_score) / idt.usulan_kegiatan_score) * 100 / idt.target_per * 100 AS capaian_awal,
                -- Terapkan batas maksimal 100%
                LEAST(
                    (SUM(p.realisasi_kegiatan_score) / idt.usulan_kegiatan_score) * 100 / idt.target_per * 100,
                    100
                ) AS capaian_akhir
            FROM indikator i
            JOIN indikator_detail idt ON i.indikator_id = idt.indikator_id
            LEFT JOIN penilaian p
                ON p.indikator_id = i.indikator_id
            AND p.indikator_detail_id = idt.indikator_detail_id
            WHERE i.tahun ='2026'
            GROUP BY i.bidang_id, idt.indikator_detail_id, idt.usulan_kegiatan_score, idt.target_per
        ) AS sub
        JOIN bidang b ON sub.bidang_id = b.bidang_id
        GROUP BY b.bidang_id, b.nama_bidang
        ORDER BY b.nama_bidang
        ;

        ");

        $categories = []; // untuk xaxis
        $realisasiData = [];  // untuk series pertama
        $usulanData = [];   // untuk series kedua

        foreach ($laporan as $item) {
            $categories[] = $item->nama_bidang;
            $realisasiData[] = round($item->rata_rata_capaian, 2); // optional: 2 desimal
        }

        // print_r($laporan);
        $total_indikator = IndikatorModel::count();
        $total_user = User::count();
        //  = DB::table('penilaian')->sum('realisasi_kegiatan_score');
        // $target_kegiatan = DB::table('indikator_detail')->sum('usulan_kegiatan_score');
        $pagu_anggaran = DB::table('indikator')->sum('pagu_anggaran');
        $realisasi_anggaran = DB::table('indikator_detail')->where('triwulan', 4)->sum('realisasi_anggaran');

        $persen_kegiatan_result = DB::select("SELECT AVG(capaian_akhir) AS total_capaian
FROM (
    SELECT
        idt.indikator_detail_id,
        -- Hitung capaian akhir per kegiatan dan normalisasi maksimal 100%
        LEAST(
            (SUM(p.realisasi_kegiatan_score) / idt.usulan_kegiatan_score) * 100 / idt.target_per * 100,
            100
        ) AS capaian_akhir
    FROM indikator i
    JOIN indikator_detail idt ON i.indikator_id = idt.indikator_id
    LEFT JOIN penilaian p
        ON p.indikator_id = i.indikator_id
       AND p.indikator_detail_id = idt.indikator_detail_id
    GROUP BY idt.indikator_detail_id, idt.usulan_kegiatan_score, idt.target_per
) AS sub;");

        $persen_kegiatan = $persen_kegiatan_result[0]->total_capaian;

        return view('dashboard', compact(
            'total_indikator',
            'total_user',
            'persen_kegiatan',
            'pagu_anggaran',
            'categories',
            'realisasiData',
            'realisasi_anggaran'
        ));
    }
}
