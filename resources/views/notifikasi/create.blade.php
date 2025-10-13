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
                            <h5 class="m-b-10">Notifikasi</h5>
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
                <h5 class="mb-3">Daftar Indikator</h5>
                <div class="card tbl-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-end mb-4">
                            <h3 class="mb-0"><b>Daftar</b></h3>
                        </div>
                        <form action="{{ route('notifikasi.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group mb-3">
                                <label class="form-label">Penerima</label>
                                <select id="" name="user" class="form-select">
                                    @foreach ($user as $data)
                                    <option value="{{ $data->user_id }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Jenis</label>
                                <input type="text" class="form-control" name="jenis" placeholder="Jenis Pesan">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Pesan</label>
                                <textarea type="text" class="form-control" name="pesan" placeholder="Masukkan Pesan"></textarea>
                            </div>
                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-primary">Buat</button>
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