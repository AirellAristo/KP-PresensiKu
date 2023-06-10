@extends('admin.layout.index')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Bayar Gaji Karyawan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item active">Bayar Gaji Karyawan</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Gaji</h5>
                            <br>

                            <!-- Default Table -->
                           <table class="table">
                                <thead>
                                    <tr class>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Karyawan</th>
                                        <th scope="col">Jabatan</th>
                                        <th scope="col">Gaji</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Bukti Transfer</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataKaryawan as $data)
                                        <tr class>
                                            <th>{{ $no++ }}.</th>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->jabatan }}</td>
                                            <td>{{ $data->gaji }}</td>
                                            <td>
                                                @if (in_array($data->id,$buktiBayarGaji))
                                                    {{ 'Sudah Bayar' }}
                                                @else
                                                    {{ 'Belum Bayar' }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array($data->id,$buktiBayarGaji))
                                                    <a href="/#klikDisini">Test</a>
                                                @else
                                                    {{ "-" }}
                                                @endif
                                            </td>
                                            <td><a class="btn btn-success" href="{{ url('/gaji/bayar/'.$data->id) }}"><i class="bi bi-cash-coin"></i></a></td>
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
