@extends('admin.layout.index')
@section('content')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile Setting</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
          <li class="breadcrumb-item active">Profile Setting</li>
        </ol>
      </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-10">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="{{ url("/setting/perusahaan") }}">&nbsp;&nbsp;<u>- Edit/Lihat Profile Perusahaan</u></a></li>

                    <li class="list-group-item">&nbsp; - Buka/Tutup Presensi :
                        @if($companyStatus[0]->status == "tutup")
                            <a class="btn btn-success" href="{{ url("/setting/presensi/buka") }}">Buka</a>
                        @else
                            <a class="btn btn-danger" href="{{ url("/setting/presensi/tutup") }}">Tutup</a>
                        @endif
                    </li>
                    <li class="list-group-item">
                        <form id="myForm" action="{{ url("/setting/perusahaan/titik") }}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" id="latitude"  name="latitude" value="">
                            <input type="hidden" id="longitude"  name="longitude" value="">
                            <button type="submit" class="btn btn-link" onclick="myFunction(event)">- Atur Titik Perusahaan</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </section>

</main>
<script>
    function myFunction(event){
        event.preventDefault();
        var cek = confirm("Yakin Ingin Mengganti Lokasi ?");
        if(cek){
            var form = document.getElementById("myForm");
            form.submit();
        }
    }
      function Location() {
        if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var userLatitude = position.coords.latitude;
                    var userLongitude = position.coords.longitude;

                    console.log(userLatitude,userLongitude)
                    document.getElementById('latitude').value = userLatitude
                    document.getElementById('longitude').value = userLongitude
                });
            }
        }
    Location()
</script>
@endsection
