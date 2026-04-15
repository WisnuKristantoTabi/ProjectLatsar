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
                            <h5 class="m-b-10">Indikator</h5>
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
                @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <h5 class="mb-3">Ubah Indikator</h5>
                <div class="card tbl-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-end mb-4">
                            <h3 class="mb-0"><b>Edit</b></h3>
                        </div>
                        <form action="{{ route('indikator.update', $indikatorModel->indikator_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label class="form-label">Sasaran Kinerja</label>
                                <textarea type="text" class="form-control" name="sasaran" placeholder="Sasaran Kinerja">{{$indikatorModel->sasaran}}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Indikator Kinerja</label>
                                <textarea type="text" class="form-control" name="indikatorkinerja" placeholder="Indikator Kinerja">{{$indikatorModel->indikator_kinerja}}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Target</label>
                                <input type="text" min=0 class="form-control" name="target" value="{{$indikatorModel->target}}" placeholder="Target Kinerja">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Jenis Target</label>
                                <select id="" name="target_jenis" class="form-select">
                                    <option value="persen(%)" @selected($indikatorModel->target_jenis == "persen(%)")>Persen(%)</option>
                                    <option value="dokumen" @selected($indikatorModel->target_jenis == "dokumen") disabled>Dokumen</option>
                                    <option value="orang" @selected($indikatorModel->target_jenis == "orang") disabled>Orang</option>
                                    <option value="indeks" @selected($indikatorModel->target_jenis == "indeks")>Indeks</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Pagu Anggaran</label>
                                <input type="number" min=0 class="form-control" name="paguanggaran" value="{{$indikatorModel->pagu_anggaran}}" placeholder="Pagu Anggaran">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Bidang</label>
                                <select id="" name="bidang" class="form-select">
                                    @foreach ($bidang as $data)
                                    <option value="{{ $data->bidang_id }}" @selected($data->bidang_id == $indikatorModel->bidang_id )>{{ $data->nama_bidang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Koreksi Normalisasi</label>
                                <input type="number" min=0 class="form-control" name="koreksinormalisasi" value="{{$indikatorModel->koreksi_normalisasi}}" placeholder="Koreksi Normalisasi">
                                <div class="form-text">
                                    Angka dalam bentuk persen (%)
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Tahun</label>
                                <select id="" name="tahun" class="form-select">
                                    <option value="2026">2026</option>
                                    <option value="2025">2025</option>
                                </select>
                            </div>
                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-warning">Perbaharui</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End simple-page --->
        </div>
    </div>
</div>

<!-- [Page Specific JS] start -->
<script src="{{ asset('js/plugins/apexcharts.min.js')"></script>
<script src="{{ asset('js/pages/dashboard-default.js')"></script>
<!-- [Page Specific JS] end -->
@endsection