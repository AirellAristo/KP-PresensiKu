@extends('landingpage.layout.index')
@section('content')
    <section class="page-section bg-light" id="team">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Data Alpha</h2>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <th>{{ $no++ }}.</th>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->locale('id')->Format('d M Y') }}</td>
                                <td>{{ $item->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
