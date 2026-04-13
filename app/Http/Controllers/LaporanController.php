<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndikatorDetailModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporan = IndikatorDetailModel::withSum('penilaian', 'realisasi_kegiatan_score')
            ->with(['indikator', 'bidang'])
            ->get(['id', 'usulan_kegiatan_name']);
        return view('laporan.index', compact('laporan'));
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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function downloadPDF()
    {
        $laporan = IndikatorDetailModel::withSum('penilaian', 'realisasi_kegiatan_score')
            ->with(['indikator', 'bidang'])
            ->get(['id', 'usulan_kegiatan_name']);

        $pdf = Pdf::loadView('laporan.laporan', compact('laporan'))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
            ]);

        return $pdf->download('laporan-data.pdf');
    }

    public function download()
    {

        $laporan = IndikatorDetailModel::withSum('penilaian', 'realisasi_kegiatan_score')
            ->with(['indikator', 'bidang', 'penilaian'])
            ->get(['id', 'usulan_kegiatan_name']);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A2', 'No.');
        $sheet->setCellValue('B2', 'Sasaran');
        $sheet->setCellValue('C2', 'Indikator Kinerj');
        $sheet->setCellValue('D2', 'Target');
        $sheet->setCellValue('E2', 'Triwulan');
        $sheet->setCellValue('F2', 'Kegiatan');
        $sheet->setCellValue('G2', 'Nama Target');
        $sheet->setCellValue('H2', 'Target Kegiatan');
        $sheet->setCellValue('I2', 'Nama Realisasi');
        $sheet->setCellValue('J2', 'Realisasi Kegiatan');
        $sheet->setCellValue('K2', 'TargetTW');
        $sheet->setCellValue('L2', 'Persentase Realisasi Triwulan');
        $sheet->setCellValue('M2', 'Persentase Capaian Triwulan');
        $sheet->setCellValue('N2', 'Keterangan');
        $sheet->setCellValue('O2', 'Pagu Anggaran');
        $sheet->setCellValue('P2', 'Realisasi Anggaran');
        $sheet->setCellValue('Q2', 'Persentase Capaian Anggaran');
        $sheet->setCellValue('R2', 'Normalisasi Capaian PK (1)');
        $sheet->setCellValue('S2', 'Koreksi Normalisasi Capaian PK Berdasarkan Predikat AKIP (2)');
        $sheet->setCellValue('T2', 'Data Dukung');
        $sheet->setCellValue('U2', 'Nilai Akhir Capaian PK');
        $sheet->setCellValue('V2', 'Bidang');

        foreach ($laporan as $loopIndex => $data) {
            $row = $loopIndex + 3;

            $sheet->setCellValue('A' . $row, $loopIndex + 1);
            $sheet->setCellValue('B' . $row, $data->indikator->sasaran);
            $sheet->setCellValue('C' . $row, $data->indikator->indikator_kinerja);
            $sheet->setCellValue('D' . $row, $data->indikator->target);
            $sheet->setCellValue('E' . $row, $data->triwulan);
            $sheet->setCellValue('F' . $row, $data->kegiatan_name);
            $sheet->setCellValue('G' . $row, $data->usulan_kegiatan_name);
            $sheet->setCellValue('H' . $row, $data->usulan_kegiatan_score);
            $sheet->setCellValue('I' . $row, $data->realisasi_kegiatan_name);
            $sheet->setCellValue('J' . $row, $data->penilaian_sum_realisasi_kegiatan_score);
            // target per dalam bentuk angka persentase
            $sheet->setCellValue('K' . $row, $data->target_per / 100);
            $sheet->getStyle('K' . $row)->getNumberFormat()->setFormatCode('0%');
            $sheet->setCellValue('L' . $row, "=IFERROR((J" . $row . "/H" . $row . ")*100%,\"\")");
            $sheet->getStyle('L' . $row)
                ->getNumberFormat()
                ->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00);
            $sheet->setCellValue('M' . $row, "=IFERROR((L" . $row . "/K" . $row . ")*100%,\"\")");
            $sheet->getStyle('M' . $row)
                ->getNumberFormat()
                ->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00);
            $sheet->setCellValue('N' . $row, $data->keterangan);
            $sheet->setCellValue('O' . $row, $data->indikator->pagu_anggaran);
            $sheet->setCellValue('P' . $row, $data->realisasi_anggaran);
            $sheet->setCellValue('Q' . $row, "=IFERROR((P" . $row . "/O" . $row . ")*100%,\"\")");
            $sheet->getStyle('Q' . $row)
                ->getNumberFormat()
                ->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00);
            $sheet->setCellValue('R' . $row, "=IF(M" . $row . ">110%,110%,M" . $row . ")");
            $sheet->getStyle('R' . $row)
                ->getNumberFormat()
                ->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00);
            $sheet->setCellValue('S' . $row, $data->indikator->koreksi_normalisasi . "%");
            $sheet->getStyle('S' . $row)
                ->getNumberFormat()
                ->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00);
            $supportingTexts = $data->penilaian->pluck('suppporting_data')->toArray();
            $sheet->setCellValue('T' . $row, implode(", \n", $supportingTexts));
            // $sheet->setCellValue('U' . $row, "=(R" . $row . "*(100%-S" . $row . "))");
            $sheet->setCellValue('U' . $row, "=IF(S$row=\"\",\"\",R$row*(1-S$row))");
            $sheet->getStyle('U' . $row)
                ->getNumberFormat()
                ->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00);
            $sheet->setCellValue('V' . $row, $data->bidang->nama_bidang);
        }


        // <td>
        //                                 $realisasi = 0 ;
        //                                 if ($data->usulan_kegiatan_score != 0) {
        //                                 $realisasi = ($data->penilaian_sum_realisasi_kegiatan_score/$data->usulan_kegiatan_score)*100;
        //                                 echo round($realisasi,2) . "%";
        //                                 }
        //                             </td>
        //                             <td>
        //                                 @php
        //                                 $per_capaian=0;
        //                                 if ($data->usulan_kegiatan_score != 0) {
        //                                 $per_capaian = ($realisasi/$data->target_per)*100;
        //                                 echo round($per_capaian,2) . "%";
        //                                 }
        //                                 @endphp
        //                             </td>
        //                             <td>
        //                                 -0
        //                             </td>
        //                             <td>
        //                                 -0
        //                             </td>
        //                             <td>
        //                                 {{ $data->keterangan }}
        //                             </td>
        //                             <td>
        //                                 Rp.{{ number_format( $data->indikator->pagu_anggaran, 0, ',', '.') }}
        //                             </td>
        //                             <td>
        //                                 Rp.{{ number_format( $data->realisasi_anggaran, 0, ',', '.') }}
        //                             </td>
        //                             <td>
        //                                 @php
        //                                 $per_realisasianggaran = 0;
        //                                 if ($data->indikator->pagu_anggaran != 0) {
        //                                 $per_realisasianggaran = ($data->realisasi_anggaran/$data->indikator->pagu_anggaran)*100;
        //                                 echo round($per_realisasianggaran,2) . "%";
        //                                 }
        //                                 @endphp
        //                             </td>
        //                             <td>
        //                                 @php
        //                                 $normalisasi = 0;
        //                                 if ( $per_capaian > 110) {
        //                                 $normalisasi = 110;
        //                                 echo round($normalisasi,2)."%";
        //                                 }else{
        //                                 $normalisasi = $per_capaian;
        //                                 echo round($normalisasi,2) . "%";
        //                                 }
        //                                 @endphp
        //                             </td>
        //                             <td>
        //                                 {{ $data->indikator->koreksi_normalisasi }}%
        //                             </td>
        //                             <td>
        //                                 @php
        //                                 $hasil =(($normalisasi/100)*( 1 - ($data->indikator->koreksi_normalisasi/100) ))*100;
        //                                 echo $hasil."%";
        //                                 @endphp
        //                             </td>
        //                             <td>
        //                                 {{$data->bidang->nama_bidang}}
        //                             </td>
        //                         </tr>

        $sheet->getStyle('W' . $row)
            ->getAlignment()
            ->setWrapText(true);

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Laporan.xlsx';

        // Output file ke browser
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"{$fileName}\"");
        $writer->save('php://output');
    }
}
