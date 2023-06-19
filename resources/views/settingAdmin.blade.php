@extends('admin.layout.index')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile Setting</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
          <li class="breadcrumb-item active">Profile Setting</li>
        </ol>
      </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-10">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="{{ url("/setting/perusahaan") }}">- Edit/Lihat Profile Perusahaan</a></li>

                    <li class="list-group-item">- Buka/Tutup Presensi :
                        @if($companyStatus[0]->status == "tutup")
                            <a class="btn btn-success" href="{{ url("/setting/presensi/buka") }}">Buka</a>
                        @else
                            <a class="btn btn-danger" href="{{ url("/setting/presensi/tutup") }}">Tutup</a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </section>

</main>
@endsection
