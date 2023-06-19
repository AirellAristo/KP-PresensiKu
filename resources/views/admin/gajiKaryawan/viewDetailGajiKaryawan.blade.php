@extends('admin.layout.index')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Bayar Gaji Karyawan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                    <li class="breadcrumb-item "><a href="{{ url('/gaji') }}">Bayar Gaji Karyawan</a></li>
                    <li class="breadcrumb-item active">Detail Gaji Karyawan</li>
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
                                        <th scope="col">Bulan</th>
                                        <th scope="col">Bukti Transfer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detailGajiKaryawan as $data)
                                        <tr class>
                                            <th>{{ $no++ }}.</th>
                                            <td>{{ date("F Y", strtotime($data->created_at)) }}</td>
                                            <td> <a href="{{ url('storage/'.$data->bukti_transfer_gaji) }}"  target="_blank">{{ substr($data->bukti_transfer_gaji, strpos($data->bukti_transfer_gaji, '/') + 1) }}</a></td>
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
