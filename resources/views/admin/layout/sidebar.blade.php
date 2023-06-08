<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link {{ request()->url() === url('/setting') ? 'active' : 'collapsed' }}" href="{{ url('/setting') }}">
            <i class="bi bi-gear"></i>
          <span>Setting</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->url() === url('/jabatan') ? 'active' : 'collapsed' }}" href="{{ url('/jabatan') }}">
            <i class="bi bi-briefcase-fill"></i>
          <span>Jabatan</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->url() === url('/karyawan') ? 'active' : 'collapsed' }}" href="{{ url('/karyawan') }}">
          <i class="bi bi-newspaper"></i>
          <span>Data Karyawan</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->url() === url('/karyawan/cuti') ? 'active' : 'collapsed' }}" href="{{ url('/karyawan/cuti') }}">
          <i class="bi bi-exclamation-lg"></i>
          <span>Permintaan Cuti &nbsp;</span>
          {{-- @if (session('jumlahPermintaan') != 0)
          <span class="badge rounded-pill bg-danger">{{ session('jumlahPermintaan') }}</span>
          @endif --}}

        </a>
      </li>

    </ul>

  </aside>

