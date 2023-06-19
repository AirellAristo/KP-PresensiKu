@extends('landingpage.layout.index')
@section('content')
    <section class="page-section bg-light" id="team">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Riwayat Gaji</h2>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered table-light ">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Slip Gaji</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detailGajiKaryawan as $data)
                            <tr>
                                <th>{{ $no++ }}.</th>
                                            <td>{{ date("F Y", strtotime($data->created_at)) }}</td>
                                            <td> <a href="{{ url('storage/'.$data->bukti_transfer_gaji) }}"  target="_blank">{{ substr($data->bukti_transfer_gaji, strpos($data->bukti_transfer_gaji, '/') + 1) }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
