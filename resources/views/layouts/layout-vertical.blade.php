<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ url('/dashboard') }}" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                <img src="{{ asset('images/logo-kemenkum.svg') }}" class="img-fluid" alt="logo">
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <!-- menu list -->
                <li class="pc-item">
                    <a href="{{ url('/dashboard') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                <!-- <li class="pc-item pc-caption">
                    <label>UI Components</label>
                    <i class="ti ti-dashboard"></i>
                </li> -->
                <li class="pc-item">
                    <a href="{{ route('user.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti ti-user"></i></span>
                        <span class="pc-mtext">User</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{ route('indikator.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti ti ti-file-info"></i></span>
                        <span class="pc-mtext">Indikator</span>
                    </a>
                </li>
                <!-- end menu list -->
            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->