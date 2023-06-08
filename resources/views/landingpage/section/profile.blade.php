@extends('landingpage.layout.index')
@section('content')

    <section class="page-section " id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Profile</h2>
            </div>
            <center>
                <div class="box">
                    <form method="POST" action="/profile">
                        @method('PUT')
                        @csrf
                        <div class="row mb-3 ps-5 pe-5" style="text-align: left">
                            <label for="name" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ $profile[0]->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label for="email" class="col-sm-2 col-form-label mt-3">Email</label>
                            <div class="col-sm-10 mt-3">
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ $profile[0]->email }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label for="jabatan" class="col-sm-2 col-form-label mt-3">Jabatan</label>
                            <div class="col-sm-10 mt-3">
                                <input type="text" class="form-control" disabled id="jabatan" name="jabatan"
                                    value="{{ $profile[0]->jabatan }}">
                            </div>
                            <label for="nomor_telepon" class="col-sm-2 col-form-label mt-3">Nomor Telepon</label>
                            <div class="col-sm-10 mt-3">
                                <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror"
                                    id="nomor_telepon" name="nomor_telepon" value="{{ $profile[0]->nomor_telepon }}">
                                @error('nomor_telepon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label for="alamat" class="col-sm-2 col-form-label mt-3">Alamat</label>
                            <div class="col-sm-10 mt-3">
                                <textarea name="alamat" id="alamat" cols="25" rows="3"
                                    class="form-control @error('alamat') is-invalid @enderror">{{ $profile[0]->alamat }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-info">Update</button>
                                <a class="btn btn-danger" href="{{ url('/') }}">Batal</a>
                            </div>
                        </div>

                    </form>

                </div>
            </center>
        </div>
    </section>
@endsection
