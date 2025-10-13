<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    @include('layouts.head-page-meta')
    @include('layouts.head-css')
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    @include('layouts.layout-vertical')
    <!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
    <header class="pc-header">
        <div class="header-wrapper"> <!-- [Mobile Media Block] start -->
            <div class="me-auto pc-mob-drp">
                <ul class="list-unstyled">
                    <!-- ======= Menu collapse Icon ===== -->
                    <li class="pc-h-item pc-sidebar-collapse">
                        <a href="#" class="pc-head-link ms-0" id="sidebar-hide">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                    <li class="pc-h-item pc-sidebar-popup">
                        <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- [Mobile Media Block end] -->
            <div class="ms-auto">
                <ul class="list-unstyled">
                    <li class="dropdown pc-h-item">
                        <a
                            class="pc-head-link dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-haspopup="false"
                            aria-expanded="false">
                            <i class="ti ti-mail"></i>
                        </a>
                        <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header d-flex align-items-center justify-content-between">
                                <h5 class="m-0">Message</h5>
                                <a href="#!" class="pc-head-link bg-transparent"><i class="ti ti-x text-danger"></i></a>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-header px-0 text-wrap header-notification-scroll position-relative" style="max-height: calc(100vh - 215px)">
                                <div class="list-group list-group-flush w-100">
                                    @foreach($notifikasi_global as $notif)
                                    <form action="{{ route('notif.baca', $notif->notifikasi_id) }}" method="POST">
                                        <!-- <a href="#" class="list-group-item list-group-item-action" onclick="baca('tes') "> -->
                                        @csrf
                                        <button type="submit" class="list-group-item list-group-item-action">
                                            <div class="d-flex">
                                                <div class="flex-grow-1 ms-1">
                                                    <span class="float-end text-muted"></span>
                                                    <p class="text-body mb-1"> {{ $notif->jenis }}</p>
                                                    <p>{{ \Illuminate\Support\Str::limit( $notif->pesan,30,'...') }}</p>
                                                    <span class="text-muted">{{ $notif->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                            <!-- </a> -->
                                        </button>
                                    </form>
                                    @endforeach
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="text-center py-2">
                                <a href="{{ route('notif.index',session('userid') ) }}" class="link-primary">View all</a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown pc-h-item header-user-profile">
                        <a
                            class="pc-head-link dropdown-toggle arrow-none me-0"
                            data-bs-toggle="dropdown"
                            href="#"
                            role="button"
                            aria-haspopup="false"
                            data-bs-auto-close="outside"
                            aria-expanded="false">
                            <!-- <img src="../assets/images/user/avatar-2.jpg" alt="user-image" class="user-avtar"> -->
                            <span>{{ session('username') }}</span>
                        </a>
                        <div class=" dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                            <div class="dropdown-header">
                                <div class="d-flex mb-1">
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-1">{{ session('username') }}</h6>
                                        <span>
                                            -
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <ul class="nav drp-tabs nav-fill nav-tabs" id="mydrpTab" role="tablist">
                            </ul>
                            <div class="tab-content" id="mysrpTabContent">
                                <div class="tab-pane fade show active" id="drp-tab-1" role="tabpanel" aria-labelledby="drp-t1" tabindex="0">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="ti ti-power"></i>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <!-- [ Header ] end -->



    <!-- [ Main Content ] start -->
    @yield('content')
    <!-- [ Main Content ] end -->
    <footer class="pc-footer">
        <div class="footer-wrapper container-fluid">
            <!-- <div class="row">
                <div class="col-sm my-1">
                    <p class="m-0">Mantis &#9829; crafted by Team <a href="https://themeforest.net/user/codedthemes" target="_blank">Codedthemes</a> Distributed by <a href="https://themewagon.com/">ThemeWagon</a>.</p>
                </div>
                <div class="col-auto my-1">
                    <ul class="list-inline footer-link mb-0">
                        <li class="list-inline-item"><a href="../index.html">Home</a></li>
                    </ul>
                </div>
            </div> -->
        </div>
    </footer>


    @include('layouts.footer-js')

</body>
<!-- [Body] end -->

</html>