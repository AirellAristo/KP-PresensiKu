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
                                          <input name="distance" id="distance" type="hidden" value="">
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
<script src="https://cdn.jsdelivr.net/npm/geolib@3.3.3/lib/index.min.js"></script>
    </section>
<script>
    function attendance() {
        if ("geolocation" in navigator) {
                var company = {!! json_encode($company) !!}
                navigator.geolocation.getCurrentPosition(function(position) {
                    // ini posisi saat ini
                    var userLatitude = position.coords.latitude;
                    var userLongitude = position.coords.longitude;

                    // Posisi Kantor
                    var office = {
                        longitude: company[0]['longitude'],
                        latitude: company[0]['latitude']
                    };

                    // ini jarak keduanya
                    var distance = geolib.getDistance(office, {
                        latitude: userLatitude,
                        longitude: userLongitude
                    });

                    console.log(userLatitude,userLongitude)
                    console.log(distance);
                    document.getElementById('distance').value = distance
                });
            }
        }
    attendance()
</script>

@endsection
