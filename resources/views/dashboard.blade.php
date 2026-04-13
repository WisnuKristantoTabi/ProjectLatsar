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
                            <h5 class="m-b-10">Dashboard</h5>
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
            @if(session('role') == '1'||session('role') == '3')
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Jumlah Indikator</h6>
                        <h4 class="mb-3">
                            <span class="badge bg-light-primary border border-primary"><i class="ti ti-list-check"></i>{{ $total_indikator }}</span>
                        </h4>
                        <p class="mb-0 text-muted text-sm">Lihat data! <a href="{{ route('indikator.index') }}" class="text-primary">Klik disini</a>
                        </p>
                    </div>
                </div>
            </div>
            @endif
            @if(session('role') == '1')
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Users</h6>
                        <h4 class="mb-3">
                            <span class="badge bg-light-success border border-success"><i class="ti ti-users"></i>{{ $total_user }}</span>
                        </h4>
                        <p class="mb-0 text-muted text-sm">Lihat data <a href="{{ route('user.index') }}" class="text-success">Klik disini</a>
                        </p>
                    </div>
                </div>
            </div>
            @endif

            @if(session('role') == '3')
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Total Pagu</h6>
                        <h4 class="mb-3">
                            <span class="badge bg-light-success border border-success">Rp.{{ number_format($pagu_anggaran, 0, ',', '.') }}</span>
                        </h4>
                        <p class="mb-0 text-muted text-sm">
                            @if($realisasi_anggaran != 0)
                            Realisasi Anggaran : Rp.{{ number_format($realisasi_anggaran, 0, ',', '.') }}
                            @else
                            Realisasi Anggaran : Data Belum di input
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            @endif

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Persen Kegiatan</h6>
                        <h4 class="mb-3">
                            <span class="badge bg-light-warning border border-warning">{{round($persen_kegiatan,2)}} %</span>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-8">
                <h5 class="mb-3">Grafik capaian</h5>
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-2 f-w-400 text-muted">Tahun 2025</h6>
                        <div id="sales-report-chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- [Page Specific JS] start -->
<script src="{{ asset('js/plugins/apexcharts.min.js') }}"></script>
<script>
    'use strict';
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            floatchart();
        }, 500);
    });

    function floatchart() {
        (function() {
            var options = {
                chart: {
                    type: 'bar',
                    height: 430,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        columnWidth: '30%',
                        borderRadius: 4
                    }
                },
                stroke: {
                    show: true,
                    width: 8,
                    colors: ['transparent']
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    show: true,
                    fontFamily: `'Public Sans', sans-serif`,
                    offsetX: 10,
                    offsetY: 10,
                    labels: {
                        useSeriesColors: false
                    },
                    markers: {
                        width: 10,
                        height: 10,
                        radius: '50%',
                        offsexX: 2,
                        offsexY: 2
                    },
                    itemMargin: {
                        horizontal: 15,
                        vertical: 5
                    }
                },
                colors: ['#1890ff'],
                series: [{
                    name: 'Realisasi Kegiatan',
                    data: @json($realisasiData)
                }],
                xaxis: {
                    categories: @json($categories)
                },
            }
            var chart = new ApexCharts(document.querySelector('#sales-report-chart'), options);
            chart.render();
        })();
    }
</script>
<!-- [Page Specific JS] end -->
@endsection