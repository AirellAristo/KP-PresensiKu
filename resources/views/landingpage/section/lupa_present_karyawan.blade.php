@extends('landingpage.layout.index')
@section('content')
    <section class="page-section " id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Pengajuan Lupa Presensi</h2>
            </div>
            <!-- * * * * * * * * * * * * * * *-->
            <!-- * * SB Forms Contact Form * *-->
            <!-- * * * * * * * * * * * * * * *-->
            <!-- This form is pre-integrated with SB Forms.-->
            <!-- To make this form functional, sign up at-->
            <!-- https://startbootstrap.com/solution/contact-forms-->
            <!-- to get an API token!-->

                <div class="boxPenAlpha">

                    <div class="mb-5">

                        <div class="container">

                            <div class="row mx-4">

                                <div class="mt-5">
                                    <form method="POST" action="{{ url('/lupaPresensi/kirim') }}">
                                        @csrf
                                        @method('put')

                                        <label for="birthday">Kapan :</label>
                                        <select class="form-select @error('id') is-invalid @enderror" aria-label="Default select example" name="id" required>
                                            <option value=null selected>=== Pilih Data ===</option>
                                            @foreach ($dataAlpha as $data )
                                            <option value="{{ $data->id }}">{{ $data->created_at->format('l, d F Y') }}</option>
                                            @endforeach
                                          </select>
                                            @error('id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror


                                        <div class="form-group">
                                            <br>
                                            <label for="exampleFormControlTextarea1">Kegiatan Yang Dilakukan</label>
                                            <textarea name='keterangan' class="form-control" id="exampleFormControlTextarea1" rows="3" style="width: 300px;" required></textarea>
                                          </div>
                                          <button type="submit" class="btn btn-info mt-3">Kirim</button>
                                    </form>
                                </div>

                            </div>
                    </div>

                </div>

            </div>
    </section>
@endsection

