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
                            <h5><b>{{ $penilaian->indikator->sasaran}}</b></h5>
                            <p> {{ $penilaian->indikator->indikator_kinerja }}</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/penilaian/'.$penilaian->penilaian_id.'/items/update') }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id" value="{{$penilaian->indikator_detail_id}}">
                            <input type="hidden" name="idpenilaian" value="{{$penilaian->penilaian_id}}">
                            <div class="form-group mb-3">
                                <label class="form-label">{{ $penilaian->indikatordetail->realisasi_kegiatan_name }}</label>
                                <input type="number" min=0 class="form-control" name="realisasikegiatanscore" value="{{ $penilaian->realisasi_kegiatan_score }}" placeholder="Masukkan Jumlah">
                            </div>
                            <div class="input-group mb-3">
                                <span class="pc-micon pe-1"><i class="ti ti-calendar" style="font-size: 30px;"></i></span>
                                <select id="" name="month" class="form-select">
                                    @if($penilaian->indikatordetail->triwulan == 1 )
                                    <option value="1" @selected($penilaian->month == 1)>Januari</option>
                                    <option value="2" @selected($penilaian->month == 2)>Februari</option>
                                    <option value="3" @selected($penilaian->month == 3)>Maret</option>
                                    @elseif($penilaian->indikatordetail->triwulan == 2 )
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    @elseif($penilaian->indikatordetail->triwulan == 3 )
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    @elseif($penilaian->indikatordetail->triwulan == 4 )
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                    @endif
                                </select>
                                <select id="" name="year" class="form-select">
                                    <option value="2025" @selected($penilaian->year == 2025)>2025</option>
                                    <option value="2026" @selected($penilaian->year == 2026)>2026</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea type="text" class="form-control" name="keterangan" placeholder="Masukkan Keterangan">{{ $penilaian->keterangan }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Data Dukung</label>
                                <input type="text" class="form-control" name="suppportingdata" value="{{ $penilaian->suppporting_data }}" placeholder="Masukkan Link">
                                <div class="form-text">
                                    Data dukung dapat berupa file/screenshot disimpan dala link googledrive
                                </div>
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