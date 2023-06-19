@extends('admin.layout.index')
@section('content')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Edit Profile Perusahaan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/setting') }}">Setting</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/setting/perusahaan') }}">Profile Perusahaan</a></li>
                <li class="breadcrumb-item active">Edit Profile Perusahaan</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-10">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Profile Perusahaan</h5>

                        <!-- General Form Elements -->
                        <form method="POST" action="{{ url('/setting/perusahaan/profile/edit') }}">
                            @csrf
                            @method('put')
                            <div class="row mb-3">
                                <label for="company_name" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                                        id="company_name" name="company_name" value="{{ $data[0]->company_name }}">
                                    @error('company_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ $data[0]->email }}">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-warning">Edit</button>
                                    <a class="btn btn-danger" href="{{ url('/setting/perusahaan') }}">Batal</a>
                                </div>
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
