@extends('admin.layout.index')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Tambah Data</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/karyawan') }}">Karyawan</a></li>
                    <li class="breadcrumb-item active">Tambah Data Karyawan</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-10">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">TAMBAH DATA KARYAWAN </h5>

                            <!-- General Form Elements -->
                            <form method="POST" action="#">
                                @csrf
                                <div class="row mb-3">
                                    <label for="nama_karyawan" class="col-sm-2 col-form-label">Nama Karyawan</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control"
                                            id="nama_karyawan" name="nama_karyawan">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Departemen</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="id_departemen">
                                            <option selected>== PILIH DEPARTEMEN ==</option>
                                            <option value="#">1</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control"
                                            id="alamat" name="alamat">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="no_hp" class="col-sm-2 col-form-label">Nomor Telephone</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control"
                                            id="no_hp" name="no_hp">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email"
                                            class="form-control"
                                            id="email" name="email">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-info">TAMBAH</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
