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
                                Indikator Kinerja
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
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Pagu Anggaran</h6>
                        <h4 class="mb-3">Rp.{{ number_format( $indikatorModel->pagu_anggaran, 0, ',', '.')}} </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Target</h6>
                        <h4 class="mb-3"><span class="badge bg-light-primary border border-primary"> {{$indikatorModel->target}} {{$indikatorModel->target_jenis}}</span>
                    </div>
                </div>
            </div>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Sasaran</h5>
                    </div>
                    <div class="card-body pc-component">
                        <p>{{$indikatorModel->sasaran}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Indikator Kinerja</h5>
                    </div>
                    <div class="card-body pc-component">
                        <p>{{$indikatorModel->indikator_kinerja}}</p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <div class="card tbl-card">
                        <div class="card-header">
                            <h5 class="mb-3"><a class="btn btn-primary" href="{{ url('/indikator/'.$indikatorModel->indikator_id.'/detail/create') }}" role="button">Tambah</a></h5>
                            <h5>Daftar Kegiatan</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless mb-0">
                                    <thead>
                                        <tr>
                                            <th>Triwulan</th>
                                            <th>Nama Kegiatan</th>
                                            <th>Nama Kegiatan Total</th>
                                            <th>Nama Kegiatan Terlaksana</th>
                                            <th class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($indikatordetail as $data)
                                        <tr>
                                            <td class="text-muted"> {{ $data->triwulan }}</td>
                                            <td>{{ $data->kegiatan_name }}</td>
                                            <td>{{ $data->usulan_kegiatan_name }}</td>
                                            <td>{{ $data->realisasi_kegiatan_name }}</td>
                                            <td class="text-end">
                                                <a href="{{ url('/indikator/'.$data->indikator_detail_id.'/detail')}}">Lihat Detail</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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