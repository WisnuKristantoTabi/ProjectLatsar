<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\PenilaianModel;
use App\Models\IndikatorDetailModel; // atau Kegiatan
use App\Models\NotifikasiModel;
use App\Models\User;

class CheckPenilaianKegiatan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-penilaian-kegiatan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bulanLalu = Carbon::now()->subMonth();
        $tahun = $bulanLalu->year;
        $bulan = $bulanLalu->month;


        // [$startMonth, $endMonth] = $this->getTriwulanByMonth($bulan);
        // Ambil semua kegiatan yang wajib dinilai
        $kegiatanList = IndikatorDetailModel::all(); // Sesuaikan dengan tabel Anda

        foreach ($kegiatanList as $kegiatan) {
            $sudahDinilai = PenilaianModel::where('indikator_detail_id', $kegiatan->id)
                // ->where('year', $tahun)
                // ->whereBetween('month', [$startMonth, $endMonth])
                ->exists();

            if (!$sudahDinilai) {
                if ($kegiatan->triwulan == $this->getTriwulanName($bulan)) {
                    $users = User::where('bidang_id', $kegiatan->bidang_id)->get();
                    foreach ($users as $user) {
                        NotifikasiModel::create([
                            'user_id' => $user->user_id,
                            'jenis' => 'Kegiatan Belum Dinilai',
                            'pesan' => "Kepada {$user->nama}, Kegiatan {$kegiatan->kegiatan_name} " .
                                $this->getTriwulanName($bulan) .
                                " belum diinput nilainya untuk bulan {$bulanLalu->translatedFormat('F Y')}.",
                        ]);
                    }
                }
            }
        }

        $this->info('✅ Pemeriksaan penilaian kegiatan selesai');
        return Command::SUCCESS;
    }
    private function getTriwulanByMonth($month)
    {
        if ($month >= 1 && $month <= 3) return [1, 3];
        if ($month >= 4 && $month <= 6) return [4, 6];
        if ($month >= 7 && $month <= 9) return [7, 9];
        return [10, 12];
    }

    private function getTriwulanName($month)
    {
        if ($month >= 1 && $month <= 3) return "1";
        if ($month >= 4 && $month <= 6) return "2";
        if ($month >= 7 && $month <= 9) return "3";
        return "4";
    }
}
