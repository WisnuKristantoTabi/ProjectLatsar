<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'penilaian_id'              =>  (string) Str::ulid(),
                'indikator_id'              => "01K4HGACCKRKJZRP27DP9J8WEG",
                'indikator_detail_id'       => "01K4PKJ4DYW3ESFPG1VCHXCN02",
                'month'                     => 1,
                'year'                      => 2025,
                'usulan_kegiatan_score'     => 2,
                'realisasi_kegiatan_score'  => 1,
                'keterangan'                => "-",
                'suppporting_data'          => "-",
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];
        DB::table('penilaian')->insert($users);
    }
}
