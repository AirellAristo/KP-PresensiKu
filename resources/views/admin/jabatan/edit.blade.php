@extends('admin.layout.index')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Data Jabatan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/jabatan') }}">Jabatan</a></li>
                    <li class="breadcrumb-item active">Edit Data Jabatan</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-10">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Data Jabatan</h5>

                            <!-- General Form Elements -->
                            <form method="POST" action="/jabatan/{{ $data->id_jabatan }}">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                            id="jabatan" name="jabatan" value="{{ $data->jabatan }}">
                                        @error('jabatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="gaji" class="col-sm-2 col-form-label">Gaji*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('gaji') is-invalid @enderror"
                                            id="gaji" name="gaji" value="{{ $data->gaji }}">
                                        @error('gaji')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-info">Tambah</button>
                                        <a class="btn btn-danger" href="{{ url('/jabatan') }}">Batal</a>
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
