<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <style>
        @page {
            size: A4 landscape;
            /* Ukuran & orientasi kertas */
            margin-top: 3mm;
            margin-right: 3mm;
            margin-bottom: 4mm;
            margin-left: 4mm;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 6px;
            margin: 0;
            padding: 0;
        }

        /* Bungkus tabel supaya tidak overflow */
        .table-wrapper {
            width: 100%;
            overflow: hidden;
        }

        /* Tabel otomatis menyesuaikan lebar halaman */
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            /* Penting agar tabel menyesuaikan halaman */
            word-wrap: break-word;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
            vertical-align: middle;
            font-size: 9px;
        }

        th {
            background-color: #f2f2f2;
        }

        thead {
            display: table-header-group;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th style="width:3%">No</th>
                <th>Sasaran</th>
                <th>Indikator Kinerja</th>
                <th>Target</th>
                <th>TRIWULAN</th>
                <th>Kegiatan</th>
                <th>Nama Target</th>
                <th>Target Kegiatan</th>
                <th>Nama Realisasi</th>
                <th>Realisasi Kegiatan</th>
                <th>TargetTW</th>
                <th>Persentase Realisasi Triwulan</th>
                <th>Persentase Capaian Triwulan</th>
                <th>Keterangan</th>
                <th>Pagu Anggaran</th>
                <th>Realisasi Anggaran </th>
                <th>Persentase Capaian Anggaran</th>
                <th>Normalisasi Capaian PK (1)</th>
                <th>Koreksi Normalisasi Capaian PK Berdasarkan Predikat AKIP (2)</th>
                <th> Nilai Akhir Capaian PK</th>
                <!-- <th>Link Data dukung</th> -->
                <th>PIC</th>
                <!-- <th class="text-end">Aksi</th> -->
            </tr>
        </thead>
        <tbody>
            @php $jum = 0; $i =0; @endphp
            @foreach ($laporan as $data)
            <tr>
                <td> {{ $loop->iteration }}</td>
                <td>{{ $data->indikator->sasaran}}</td>
                <td>{{ $data->indikator->indikator_kinerja}}</td>
                <td>{{ $data->indikator->target}}</td>
                <td>{{ $data->triwulan}}</td>
                <td>{{ $data->kegiatan_name}}</td>
                <td>{{ $data->usulan_kegiatan_name}}</td>
                <td>{{ $data->usulan_kegiatan_score}}</td>
                <td>{{ $data->realisasi_kegiatan_name}}</td>
                <td>{{ $data->penilaian_sum_realisasi_kegiatan_score}}</td>
                <td>{{ $data->target_per}} {{ $data->target_per_jenis}}</td>
                <td>@php
                    $realisasi = 0 ;
                    if ($data->usulan_kegiatan_score != 0) {
                    $realisasi = ($data->penilaian_sum_realisasi_kegiatan_score/$data->usulan_kegiatan_score)*100;
                    echo round($realisasi,2) . "%";
                    }else{
                    $realisasi = 100;
                    }
                    @endphp
                </td>
                <td>

                    @php
                    $per_capaian=0;
                    if ($data->usulan_kegiatan_score != 0) {
                    $per_capaian = ($realisasi/$data->target_per)*100;
                    echo round($per_capaian,2) . "%";
                    }else{
                    $per_capaian = ($realisasi/$data->target_per)*100;
                    }
                    @endphp
                </td>
                <td>
                    {{ $data->keterangan }}
                </td>
                <td>
                    Rp.{{ number_format( $data->indikator->pagu_anggaran, 0, ',', '.') }}
                </td>
                <td>
                    Rp.{{ number_format( $data->realisasi_anggaran, 0, ',', '.') }}
                </td>
                <td>
                    @php
                    $per_realisasianggaran = 0;
                    if ($data->indikator->pagu_anggaran != 0) {
                    $per_realisasianggaran = ($data->realisasi_anggaran/$data->indikator->pagu_anggaran)*100;
                    echo round($per_realisasianggaran,2) . "%";
                    }
                    @endphp
                </td>
                <td>
                    @php
                    $normalisasi = 0;
                    if ( $per_capaian > 110) {
                    $normalisasi = 110;
                    echo round($normalisasi,2)."%";
                    }else{
                    $normalisasi = $per_capaian;
                    echo round($normalisasi,2) . "%";
                    }
                    @endphp
                </td>
                <td>
                    {{ $data->indikator->koreksi_normalisasi }}%
                </td>
                <td>
                    @php
                    $hasil =(($normalisasi/100)*( 1 - ($data->indikator->koreksi_normalisasi/100) ))*100;
                    echo $hasil."%";
                    @endphp
                </td>
                <td>
                    {{$data->bidang->nama_bidang}}
                </td>
            </tr>
            @php $jum = $jum + $hasil;
            $i = $loop->iteration;
            @endphp
            @endforeach
        </tbody>
    </table>
</body>
@php
$nilai_terbatas = min($jum/$i, 110); // sama seperti MIN(T186;110%)

if ($nilai_terbatas > 100) {
$kategori = "ISTIMEWA";
} elseif ($nilai_terbatas > 80) {
$kategori = "BAIK";
} elseif ($nilai_terbatas > 60) {
$kategori = "BUTUH PERBAIKAN";
} elseif ($nilai_terbatas > 20) {
$kategori = "KURANG";
} else {
$kategori = "SANGAT KURANG";
}
@endphp
<div>
    <h3>Nilai :{{$jum/$i}}%</h3>
    <h3>Predikat :{{$kategori}}</h3>
</div>


</html>