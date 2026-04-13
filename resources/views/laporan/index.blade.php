@extends('layouts.layout')
@section('content')
<div class="pc-container">
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Laporan</h5>
                        </div>
                        <ul class="breadcrumb">
                            @php $segments = ''; @endphp
                            @foreach(Request::segments() as $segment)
                            @if(is_numeric($segment))
                            @continue
                            @endif
                            @php $segments .= '/' . $segment; @endphp
                            <li class="breadcrumb-item">
                                <a href="{{ url($segments) }}">{{ ucfirst($segment) }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-md-12">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <h5 class="mb-3"><a class="btn btn-success" href="{{ route('laporan.download') }}" role="button">
                            <span class="pc-micon"><i class="ti ti-download"></i></span>
                            excel
                        </a></h5>
                    <h5 class="mb-3"><a class="btn btn-danger" href="{{ route('laporan.download.pdf') }}" role="button">
                            <span class="pc-micon"><i class="ti ti-download"></i></span>
                            PDF
                        </a></h5>
                </div>
                <div class="card tbl-card">
                    <div class="card-body">
                        <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                            <table class="table table-hover table-bordered mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
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
                                        <td class="text-muted"> {{ $loop->iteration }}</td>
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
                                            echo round($hasil,2)."%";
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
                        </div>
                    </div>
                </div>
                <h3>Nilai :{{$jum/$i}}%</h3>
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
                <h3>Predikat :{{$kategori}}</h3>
            </div>
        </div>
    </div>
</div>
<style>
    thead th {
        position: sticky;
        top: 0;
        background: #f8f9fa;
        /* warna background header */
        z-index: 2;
        /* agar tetap di atas isi tabel */
    }

    .table-responsive {
        max-height: 500px;
        /* tinggi area scroll */
        overflow-y: auto;
    }
</style>
<!-- [Page Specific JS] start -->
<script src="{{ asset('js/plugins/apexcharts.min.js')"></script>
<script src="{{ asset('js/pages/dashboard-default.js')"></script>
<!-- [Page Specific JS] end -->
@endsection