@extends('landingpage.layout.index')
@section('content')
    <section class="page-section " id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Cuti</h2>
            </div>
            <!-- * * * * * * * * * * * * * * *-->
            <!-- * * SB Forms Contact Form * *-->
            <!-- * * * * * * * * * * * * * * *-->
            <!-- This form is pre-integrated with SB Forms.-->
            <!-- To make this form functional, sign up at-->
            <!-- https://startbootstrap.com/solution/contact-forms-->
            <!-- to get an API token!-->

                <div class="boxCuti">
                    <div class="mb-5">
                        <div class="container">
                            <div class="row mx-4">
                              <div class="col-sm">
                                <div class="mt-5">
                                    <form method="POST" action="{{ route('kirimCuti') }}" enctype="multipart/form-data">
                                        @csrf
                                        <label for="birthday">Mulai :</label>
                                        <input type="date" name="mulai" value="{{ $tanggalHariIni }}" required>
                                        <label for="birthday">Berakhir :</label>
                                        <input type="date" name="akhir" required>
                                        <div class="form-group">
                                            <br>
                                            <label for="exampleFormControlTextarea1">Alasan Cuti ?</label>
                                            <textarea name='keterangan' class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                          </div>
                                          <button type="submit" class="btn btn-info mt-3">Kirim</button>
                                    </form>

                                </div>
                                </div>

                                <div class="col-sm">
                                    <div class="mt-4">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered table-light ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Mulai Cuti</th>
                                                    <th scope="col">Akhir Cuti</th>
                                                    <th scope="col">Keterangan</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $item)
                                                    <tr>
                                                        <th>{{ $no++ }}.</th>
                                                        <td>{{ \Carbon\Carbon::parse($item->mulai)->locale('id')->Format('d M Y') }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($item->akhir)->locale('id')->Format('d M Y') }}</td>
                                                        <td>{{ $item->keterangan }}</td>
                                                        <td>{{ $item->status }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

