@extends('admin.layout.index')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Bayar Gaji Karyawan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item "><a href="{{ url('/gaji') }}">Bayar Gaji Karyawan</a></li>
                    <li class="breadcrumb-item active">Bayar</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-10">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Karyawan</h5>
                                <div class="form-group row">
                                    <label for="Nama" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="Nama" value=": {{ $dataDiriKaryawan[0]->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{ $dataDiriKaryawan[0]->email }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{ $dataDiriKaryawan[0]->jabatan }} ">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="row">
                <div class="col-lg-10">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Statistik Bulan Ini</h5>
                                <div class="form-group row">
                                    <label for="Nama" class="col-sm-2 col-form-label">Hadir</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="Nama" value=": {{ $jumlahKehadiranPresensi }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Izin</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{ $jumlahKehadiranIzin }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Alpha</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{ $jumlahKehadiranAlpha }}">
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <p>Rumus = Gaji Jabatan - (Jumlah Alpha x 50.000)</p>
                                        <p>Yang Harus Dibayarkan = <span style="font-weight: bold;">{{  'Rp ' . number_format($dataDiriKaryawan[0]->gaji - ($jumlahKehadiranAlpha*50000), 2, ',', '.')}}</span></p>
                                    </div>
                                    <hr>
                                    @if ($cekSudahBayar > 0)
                                        <p>Bulan Ini Sudah Dibayar</p>
                                    @else
                                    <form action="{{ url('/gaji/bayar/'.$dataDiriKaryawan[0]->id. '/kirim') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        Bukti Pembayaran: <input type="file" name="bukti" required><br>
                                        <input type="hidden" name="total_gaji" value={{ $dataDiriKaryawan[0]->gaji - ($jumlahKehadiranAlpha*50000) }}>
                                        <button type="submit" class="btn btn-success">Bayar</button>
                                    </form>
                                    @endif
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
