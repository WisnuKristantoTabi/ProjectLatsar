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
                            <h5 class="m-b-10">Tabel Indikator</h5>
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
                <h5 class="mb-3"><a class="btn btn-primary" href="{{ route('indikator.create') }}" role="button">
                        <span class="pc-micon"><i class="ti ti-plus"></i></span>
                        Tambah
                    </a></h5>
                <div class="card tbl-card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Sasaran</th>
                                        <th>Indikator Kineja</th>
                                        <th>Pagu Anggaran</th>
                                        <th class="text-end">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($indikator as $data)
                                    <tr>
                                        <td class="text-muted"> {{ $loop->iteration }}</td>
                                        <td>{{ $data->sasaran }}</td>
                                        <td>{{ $data->indikator_kinerja }}</td>
                                        <td>Rp.{{ number_format( $data->pagu_anggaran, 0, ',', '.') }}</td>
                                        <td class="text-end btn-group">
                                            <a href="{{ route('indikator.show', $data->indikator_id) }}" class="btn btn-primary btn-sm"><span class="pc-micon"><i class="ti ti-eye"></i></span></a>
                                            <a href="{{ route('indikator.edit', $data->indikator_id) }}" class="btn btn-warning btn-sm"><span class="pc-micon"><i class="ti ti-edit"></i></span></a>
                                            <a href="#" class="btn btn-danger btn-sm"
                                                onclick="event.preventDefault(); if(confirm('Apakah yakin hapus data ini?')) { document.getElementById('delete-data-{{ $data->indikator_id }}').submit(); }">
                                                <span class="pc-micon"><i class="ti ti-trash"></i></span>
                                            </a>
                                            <form id="delete-data-{{ $data->indikator_id }}" action="{{ route('indikator.destroy', $data->indikator_id) }}" method="POST" style="display:none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
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