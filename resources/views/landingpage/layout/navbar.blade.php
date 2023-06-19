<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#page-top">PRESENSIKU</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">


                    @if (auth()->check())
                        <li class="nav-item"><a class="nav-link {{ request()->url() === url('/absent') ? 'active' : '' }}" href="{{ url('/absent') }}">PRESENSI</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->url() === url('/lupaPresensi') ? 'active' : '' }}" href="{{ url('/lupaPresensi') }}">LUPA PRESENSI</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->url() === url('/cuti') ? 'active' : '' }}" href="{{ url('/cuti') }}">CUTI</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->url() === url('/data_absensi') ? 'active' : '' }}" href="{{ url('/data_absensi') }}">DATA PRESENSI</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->url() === url('/riwayat_gaji') ? 'active' : '' }}" href="{{ url('/riwayat_gaji') }}">RIWAYAT GAJI</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->url() === url('/profile') ? 'active' : '' }}" href="{{ url('/profile') }}">PROFILE</a></li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-primary" role="button">LOGOUT</button>
                        </form>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">HOME</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}">ABOUT</a></li>
                        <a class="btn btn-primary" href="{{ url('/login') }}" role="a">LOGIN</a>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
