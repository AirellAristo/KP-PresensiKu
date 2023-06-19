@extends('landingpage.layout.index')
@section('content')
    <section class="page-section " id="contact">
        <div class="container">
            <div class="text-center">
                <h2 class="section-heading text-uppercase">Presensi</h2>
            </div>
            <!-- * * * * * * * * * * * * * * *-->
            <!-- * * SB Forms Contact Form * *-->
            <!-- * * * * * * * * * * * * * * *-->
            <!-- This form is pre-integrated with SB Forms.-->
            <!-- To make this form functional, sign up at-->
            <!-- https://startbootstrap.com/solution/contact-forms-->
            <!-- to get an API token!-->

                <div class="box">
                    <div class="mb-5">
                    <div class="container_calendar">

                        <div class="container">
                            <div class="row">
                              <div class="col-sm">
                                <div class="dycalendar" id="dycalendar"></div>
                              </div>
                              <div class="col-sm">
                                <div class="mt-5">
                                    <form method="POST" action="{{ route('absent') }}" enctype="multipart/form-data">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Kegiatan</label>
                                            <textarea name='keterangan' class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                                          </div>
                                          <button class="btn btn-info mt-3">Hadir</button>
                                        {{-- <button id="submitBtn" class="btn btn-info mt-3">Submit</button> --}}
                                    </form>
                                </div>
                                </div>
                            </div>
                    </div>
                    </div>
{{-- Calendar Script --}}
<script src="https://cdn.jsdelivr.net/npm/dycalendarjs@1.2.1/js/dycalendar.js"></script>
<script src="{{ asset('landing/js/scripts_calendar.js') }}"></script>
    </section>
@endsection

