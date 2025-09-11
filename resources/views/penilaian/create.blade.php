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
                            <h5 class="m-b-10">Input Penilaian</h5>
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
                <h5 class="mb-3">Penilai Kinerja</h5>
                <div class="card tbl-card">
                    <div class="card-header">
                        <div class="mb-4">
                            <h5><b>{{ $indikatordetail->indikator->sasaran}}</b></h5>
                            <p> {{ $indikatordetail->indikator->indikator_kinerja }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/penilaian/store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="indikatordetailid" value="{{ $indikatordetail->indikator_detail_id }}">
                            <input type="hidden" name="indikatorid" value="{{ encrypt($indikatordetail->indikator_id) }}">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ $indikatordetail->usulan_kegiatan_name }}</label>
                                <input type="number" min=0 class="form-control" name="usulankegiatanscore" placeholder="Masukan Jumlah">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">{{ $indikatordetail->realisasi_kegiatan_name }}</label>
                                <input type="number" min=0 class="form-control" name="realisasikegiatanscore" placeholder="Masukkan Jumlah">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Bulan</label>
                                <select id="" name="month" class="form-select">
                                    @if($indikatordetail->triwulan == 1 )
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    @elseif($indikatordetail->triwulan == 2 )
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    @elseif($indikatordetail->triwulan == 3 )
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    @elseif($indikatordetail->triwulan == 4 )
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Tahun</label>
                                <select id="" name="year" class="form-select">
                                    <option value="2025">2025</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan"></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Data Dukung</label>
                                <input type="text" class="form-control" name="suppportingdata" placeholder="Masukkan Link">
                                <div class="form-text">
                                    Data dukung dapat berupa file/screenshot disimpan dala link googledrive
                                </div>
                            </div>
                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-primary">Tambahkan</button>
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