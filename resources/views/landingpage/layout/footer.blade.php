<footer class="footer py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 text-lg-start">Copyright &copy; siManage</div>
            <div class="col-lg-4 my-3 my-lg-0">
                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i
                        class="fab fa-twitter"></i></a>
                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i
                        class="fab fa-facebook-f"></i></a>
                <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i
                        class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="{{ asset('landing/https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js') }}">
    </script>
    <!-- Core theme JS-->
    <script src="{{ asset('/landing/js/scripts.js') }}"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="{{ asset('landing/https://cdn.startbootstrap.com/sb-forms-latest.js') }}"></script>
    {{-- Notification Toastr --}}

</footer>

{{-- jQuery CDN --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

{{-- Notification Toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    @if (Session::has('success'))
        toastr.success('{{ Session::get('success') }}');
    @endif
</script>

@if (session('error'))
    <script>
        $(document).ready(function() {
            toastr.error('{{ session('error') }}');
        });
    </script>
@endif

<script>
    $(document).ready(function() {
        $('#submitBtn').click(function(e) {
            e.preventDefault(); // Mencegah aksi default tombol submit

            // Kirim permintaan AJAX ke server
            $.ajax({
                type: 'PUT',
                url: '/absen', // Ganti dengan URL endpoint yang sesuai
                data: {
                    status: $('input[name="status"]:checked').val(),
                    keterangan: $('textarea[name="keterangan"]').val()
                },
                success: function(response) {
                    if (response.error) {
                        toastr.error(response.error);
                    } else {
                        toastr.success(response.success);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(
                        error); // Log error jika terjadi kesalahan saat permintaan AJAX
                }
            });
        });
    });
</script>

</body>

</html>
