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
                            <h5 class="m-b-10">
                                Penilai Kinerja
                            </h5>
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
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Target</h5>
                    </div>
                    <div class="card-body pc-component">
                        <h4><span class="badge bg-light-primary border border-primary">{{ $penilaian->indikator->target }} {{ $penilaian->indikator->target_jenis }}</span></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <h5>Pagu Anggaran</h5>
                    </div>
                    <div class="card-body pc-component">
                        <p>Rp.{{ number_format( $penilaian->indikator->pagu_anggaran, 0, ',', '.')}}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Deskripsi</h5>
                    </div>
                    <div class="card-body pc-component">
                        <h5>Sasaran</h5>
                        <p>{{ $penilaian->indikator->sasaran }}</p>
                        <h5>Indikator Kinerja</h5>
                        <p>{{ $penilaian->indikator->indikator_kinerja }}</p>
                        <h5>Nama Kegiatan</h5>
                        <p>{{ $penilaian->indikatorDetail->kegiatan_name }}</p>
                        <h5>Triwulan</h5>
                        <p>{{ $penilaian->indikatorDetail->triwulan }}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Penilaian</h5>
                    </div>
                    <div class="card-body pc-component">
                        <h5>Bulan</h5>
                        <p>Ke - {{ $penilaian->month }}</p>
                        <h5>{{ $penilaian->indikatorDetail->usulan_kegiatan_name }}</h5>
                        <p>{{ $penilaian->indikatorDetail->usulan_kegiatan_score }}</p>
                        <h5>{{ $penilaian->indikatorDetail->realisasi_kegiatan_name }}</h5>
                        <p>{{ $penilaian->realisasi_kegiatan_score }}</p>
                        <h5>Keterangan</h5>
                        <p>{{ $penilaian->keterangan }}</p>
                        <h5>Data dukung</h5>
                        <p>{{ $penilaian->suppporting_data }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- [Page Specific JS] start -->
<script src="{{ asset('js/plugins/apexcharts.min.js')"></script>
<script src="{{ asset('js/pages/dashboard-default.js')"></script>
<!-- [Page Specific JS] end -->
@endsection