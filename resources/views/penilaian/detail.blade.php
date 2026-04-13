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
                            <h5 class="m-b-10">Tabel Penilaian</h5>
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
                <div class="card tbl-card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered mb-0">
                                <thead class="text-center">
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Nama Kegiatan Total</th>
                                        <th rowspan="2">Nama Kegiatan Terlaksana</th>
                                        <th colspan="3">Capaian</th>
                                        <th rowspan="2">TW</th>
                                        <th class="text-end" rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th>Realisasi</th>
                                        <th>Target</th>
                                        <th>Persentase(%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penilaian as $data)
                                    <tr>
                                        <td class="text-muted"> {{ $loop->iteration }}</td>
                                        <td>{{ $data->usulan_kegiatan_name }}</td>
                                        <td>{{ $data->realisasi_kegiatan_name }}</td>
                                        @php
                                        if ($data->usulan_kegiatan_score != 0) {
                                        $capaian = ($data->penilaian_sum_realisasi_kegiatan_score / $data->usulan_kegiatan_score)* 100 ;
                                        }else{
                                        $capaian =100;
                                        }
                                        @endphp

                                        <td>
                                            <p class="{{ ($capaian >= $data->target_per) ? 'text-primary': 'text-warning' }}"> {{ $data->penilaian_sum_realisasi_kegiatan_score ?? 0 }} </P>
                                        </td>
                                        <td>
                                            <p class="{{ ($capaian >= $data->target_per) ? 'text-primary': 'text-warning' }}"> {{ $data->usulan_kegiatan_score }} </P>
                                        </td>
                                        <td>
                                            <p class="{{ ($capaian >= $data->target_per) ? 'text-primary': 'text-warning' }}">{{round($capaian,2)}} %</p>
                                        </td>
                                        <td>{{ $data->triwulan }}</td>
                                        <td class=" text-end btn-group">
                                            <a href="{{ url('/penilaian/'. $data->indikator_detail_id .'/create') }}" class="btn btn-primary btn-sm"><i class="ti ti-plus"></i></a>

                                            <a href="{{ url('/penilaian/'. $data->indikator_detail_id .'/items') }}" class="btn btn-info btn-sm"><i class="ti ti-eye"></i></a>

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

<!-- [Page Specific JS] start -->
<script src="{{ asset('js/plugins/apexcharts.min.js')"></script>
<script src="{{ asset('js/pages/dashboard-default.js')"></script>
<!-- [Page Specific JS] end -->
@endsection