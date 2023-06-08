@extends('admin.layout.index')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data Karyawan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/karyawan') }}">Karyawan</a></li>
                    <li class="breadcrumb-item active">Data Karyawan</li>
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
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{ $dataDiriKaryawan[0]->jabatan }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">No Telepon</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{ $dataDiriKaryawan[0]->nomor_telepon === NULL ? '-' : $dataDiriKaryawan[0]->nomor_telepon }}">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{ $dataDiriKaryawan[0]->alamat === NULL ? '-' : $dataDiriKaryawan[0]->alamat }}">

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
                            <h5 class="card-title">Data Kehadiran</h5>
                            <a class="btn btn-success" href="{{ url("/karyawan/info/".$dataDiriKaryawan[0]->id."/kehadiran") }}">Kehadiran</a>
                            <a class="btn btn-warning" href="{{ url("/karyawan/info/".$dataDiriKaryawan[0]->id."/cuti") }}">Cuti</a>
                            <a class="btn btn-danger" href="{{ url("/karyawan/info/".$dataDiriKaryawan[0]->id."/alpha") }}">Alpha</a>
                            @yield('dataPresensi')
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
