@extends('admin.layout.index')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Halo {{ucfirst(auth()->user()->name) }} !</h1>
      <div>
            <span>Berikut Adalah Summary Perusahanmu</span>
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row">
              <div class="col-sm">
                <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Informasi Perusahaan</div>
                    <div class="card-body">
                      <h5 class="card-title">Total Karyawan</h5>
                      <p class="card-text">Perusahaan saat ini memiliki {{ $hitungKaryawan }} Karyawan</p>
                    </div>
                </div>
              </div>
              <div class="col-sm">
                <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Presensi</div>
                    <div class="card-body">
                      <h5 class="card-title">Jumlah Karyawan</h5>
                      <p class="card-text">Hadir : {{ $hitungKaryawanHadir }}</p>
                      <p class="card-text">Alpha : {{ $hitungKaryawanAlpha }}</p>
                      <p class="card-text">Cuti : {{ count($hitungKaryawanCuti) }}</p>
                    </div>
                </div>
              </div>
              <div class="col-sm">
                <div class="card bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">Permintaan Cuti</div>
                    <div class="card-body">
                      <h5 class="card-title">Ada</h5>
                      <p class="card-text">Total <span style="color:red">{{ $hitungPermintaanCuti }}</span>  karyawan yang butuh perhatianmu. </p>
                    </div>
                </div>
              </div>
            </div>
          </div>


    </section>

</main>
@endsection
