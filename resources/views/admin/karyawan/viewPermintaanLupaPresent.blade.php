@extends('admin.layout.index')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>PENGAJUAN LUPA PRESENSI</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Pengajuan Lupa Presensi</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Pengajuan</h5>
                            <div style="display: flex; justify-content: space-between;">
                            </div>
                            <br>

                            <!-- Default Table -->
                            <table class="table" style="vertical-align: middle">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jabatan</th>
                                        <th scope="col">Kegiatan</th>
                                        <th scope="col">Kapan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataAlpha as $item)
                                        <tr>
                                            <th>{{ $no++ }}.</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->jabatan }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>{{ $item->created_at->format('l, d F Y') }}</td>
                                            <td>
                                                <form action="{{ url('/karyawan/lupaPresensi/'.$item->id) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                    <button class="btn btn-xs btn-success" type="submit" value="Setuju" name="status">Setuju</button>
                                                    <button class="btn btn-xs btn-danger" type="submit" value="Tolak" name="status">Tolak</button>
                                                </form>
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
