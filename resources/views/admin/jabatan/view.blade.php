@extends('admin.layout.index')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>JABATAN</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Jabatan</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Jabatan</h5>
                            <div style="display: flex; justify-content: space-between;">
                                <div>
                                    <a href="{{ url('/jabatan/add') }}">
                                        <button type="button" class="btn btn-info">
                                            <i class="fa-solid fa-plus"></i> Tambah Data
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <br>

                            <!-- Default Table -->
                            <table class="table" style="vertical-align: middle">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Jabatan</th>
                                        <th scope="col">Gaji</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $item)
                                        <tr>
                                            <th>{{ $no++ }}.</th>
                                            <td>{{ $item->jabatan }}</td>
                                            <td>{{ $formatted_gaji[$key] }}</td>
                                            <td>
                                                <a href="/jabatan/{{ $item->id_jabatan }}/edit"
                                                    class="btn btn-xs btn-warning"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                <a href="/jabatan/{{ $item->id_jabatan }}/delete"
                                                    class="btn btn-xs btn-danger"
                                                    onclick="return confirm('Are u Sure?');"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Default Table Example -->
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>
@endsection
