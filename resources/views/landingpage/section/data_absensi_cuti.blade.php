@extends('landingpage.layout.index')
@section('content')
    <section class="page-section bg-light" id="team">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Data Cuti</h2>
            </div>
            <a class="btn btn-success" href="{{ url("/data_absensi") }}">Kehadiran</a>
            <a class="btn btn-warning" href="{{ url("/data_absensi/cuti") }}">Cuti</a>
            <a class="btn btn-danger" href="{{ url("/data_absensi/alpha") }}">Alpha</a>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered table-light ">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Mulai Cuti</th>
                            <th scope="col">Akhir Cuti</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <th>{{ $no++ }}.</th>
                                <td>{{ \Carbon\Carbon::parse($item->mulai)->locale('id')->Format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->akhir)->locale('id')->Format('d M Y') }}</td>
                                <td>{{ $item->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
