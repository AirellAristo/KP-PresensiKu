@extends('landingpage.layout.index')
@section('content')
    <section class="page-section bg-light" id="team">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Data Kehadiran</h2>
            </div>
            <a class="btn btn-success" href="{{ url("/data_absensi") }}">Kehadiran</a>
            <a class="btn btn-warning" href="{{ url("/data_absensi/cuti") }}">Cuti</a>
            <a class="btn btn-danger" href="{{ url("/data_absensi/alpha") }}">Alpha</a>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered table-light ">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Status</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <th>{{ $no++ }}.</th>
                                <td>{{ \Carbon\Carbon::parse($item->time_in)->locale('id')->isoFormat('LLL') }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->keterangan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
