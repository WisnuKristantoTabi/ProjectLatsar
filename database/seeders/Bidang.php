<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Bidang extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'bidang_id'  =>  (string) Str::ulid(),
                'nama_bidang' => "Kekayaan Intelektual - YANKUM",
                'deskripsi'      => '',
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ],
        ];
        DB::table('bidang')->insert($users);
    }
}
