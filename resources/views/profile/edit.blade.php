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
                            <h5 class="m-b-10">Edit Profile</h5>
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
                        <!-- <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Home</li>
                        </ul> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row justify-content-md-center">
            <!-- [ sample-page ] start -->
            <div class="col-md-12 col-xl-8">
                @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <h5 class="mb-3">Edit Pengguna</h5>
                <div class="card tbl-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-end mb-4">
                            <h3 class="mb-0"><b>Edit</b></h3>
                        </div>
                        <form action="{{ route('profile.update', $user->user_id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" value="{{ $user->nama }}" placeholder="Nama Lengkap">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" value="{{ $user->username }}" disabled>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Password</label>
                                <input name="password" type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Status</label>
                                <select id="" class="form-select" disabled>
                                    <option value="1" @selected($user->role == 1)>Admin</option>
                                    <option value="2" @selected($user->role == 2)>Operator</option>
                                    <option value="3" @selected($user->role == 3)>Pimpinan</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Bidang</label>
                                <select id="" class="form-select" disabled>
                                    @foreach ($bidang as $data)
                                    <option value="{{ $data->bidang_id }}" @selected($data->bidang_id == $user->bidang_id) >{{ $data->nama_bidang }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-primary">Ubah</button>
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