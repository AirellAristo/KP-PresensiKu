@extends('admin.layout.index')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Profile Perusahaan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/setting') }}">Setting</a></li>
                    <li class="breadcrumb-item active">Profile Perusahaan</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">
                <div class="col-lg-10">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Profile Perusahaan</h5>
                            <div class="form-group row">
                                <label for="Nama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="Nama" value=": {{ $data[0]->company_name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{ $data[0]->email }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kodePerusahaan" class="col-sm-2 col-form-label">Kode Perusahaan</label>
                                <div class="col-sm-10">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value=": {{ $data[0]->id_company }}">
                                </div>
                            </div>
                            <a href="{{ url("/setting/perusahaan/profile") }}" class="btn btn-xs btn-warning">Edit</a>
                        </div>

                    </div>

                            </section>
    </main>
@endsection
