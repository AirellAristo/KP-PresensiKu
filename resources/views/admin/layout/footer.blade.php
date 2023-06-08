<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>K13 MSIB4 GITS.ID</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        <a href="#"><i class="bi bi-facebook"></i></a>
        <a href="#"><i class="bi bi-twitter"></i></a>
        <a href="#"><i class="bi bi-instagram"></i></a>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('template/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('template/assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('template/assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('template/assets/vendor/quill/quill.min.js') }}"></script>
<script src="{{ asset('template/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('template/assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('template/assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('template/assets/js/main.js') }}"></script>

{{-- jQuery CDN --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

{{-- Notification Toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
    integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

{{-- Notification Toastr --}}
<script>
    @if (Session::has('success'))
        toastr.success('{{ Session::get('success') }}');
    @endif
    @if (Session::has('error'))
        toastr.error('{{ Session::get('error') }}');
    @endif
</script>

<script>
    // Mengambil pesan notifikasi dari localStorage
    var notificationMessage = window.localStorage.getItem('notificationMessage');

    // Menghapus pesan notifikasi dari localStorage setelah diambil
    window.localStorage.removeItem('notificationMessage');

    // Menampilkan notifikasi toastr jika ada pesan
    if (notificationMessage) {
        toastr.success(notificationMessage);
    }
</script>

</html>
