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
                <h5 class="mb-3">Daftar Kegiatan</h5>
                <div class="card tbl-card">
                    <div class="card-header">
                        <div class="mb-4">
                            <h5><b>{{ $indikator->indikator->sasaran}}</b></h5>
                            <p> {{ $indikator->indikator->indikator_kinerja }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('indikator.detail.update', $indikator->indikator_detail_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{$indikator->indikator_id}}">
                            <input type="hidden" name="iddetail" value="{{$indikator->indikator_detail_id}}">
                            <div class="form-group mb-3">
                                <label class="form-label">Nama Kegiatan</label>
                                <textarea type="text" class="form-control" name="kegiatanname" placeholder="Masukkan Nama Kegiatan">{{ $indikator->kegiatan_name }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Nama Kegiatan(Jumlah Total)</label>
                                <textarea type="text" class="form-control" name="usulankegiatanname" placeholder="Masukan Nama Kegiatan">{{ $indikator->usulan_kegiatan_name }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Jumlah Total Kegiatan</label>
                                <input type="number" min=0 class="form-control" name="usulankegiatanscore" placeholder="Masukan Total Kegiatan" value="{{ $indikator->usulan_kegiatan_score }}"></input>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Nama Kegiatan(Jumlah Yang Telaksana)</label>
                                <textarea type="text" class="form-control" name="usulankegiatanrealisasi" placeholder="Masukkan Nama Kegiatan">{{ $indikator->realisasi_kegiatan_name }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea type="text" class="form-control" name="keterangan" placeholder="Keterangan">{{ $indikator->keterangan }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Target</label>
                                <input type="number" min=0 class="form-control" name="targetper" value="{{ $indikator->target_per }}" placeholder="Target Kinerja">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Jenis Target</label>
                                <select id="" name="targetperjenis" class="form-select">
                                    <option value="persen(%)" @selected($indikator->target_jenis == "persen(%)")>Persen(%)</option>
                                    <option value="dokumen" @selected($indikator->target_jenis == "dokumen")>Dokumen</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Triwulan</label>
                                <select id="" name="triwulan" class="form-select">
                                    <option value="1" @selected($indikator->triwulan == "1")>I</option>
                                    <option value="2" @selected($indikator->triwulan == "2")>II</option>
                                    <option value="3" @selected($indikator->triwulan == "3")>III</option>
                                    <option value="4" @selected($indikator->triwulan == "4")>IV</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Realisasi Anggaran</label>
                                <input type="number" min=0 class="form-control" name="realisasianggaran" value="{{ $indikator->realisasi_anggaran }}" placeholder="Realisasi Anggaran">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Bidang</label>
                                <select id="" name="bidang" class="form-select">
                                    @foreach ($bidang as $data)
                                    <option value="{{ $data->bidang_id }}" @selected($data->bidang_id == $indikator->bidang_id )>{{ $data->nama_bidang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-warning">Ubah</button>
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