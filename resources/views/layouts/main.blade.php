<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CV Anugrah Abadi</title>
    {{-- <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" /> --}}
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}" />
    {{-- <link rel="stylesheet" href="../assets/css/styles.min.css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
</head>
<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('layouts.sidebar')
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <div class="container-fluid" style="padding-top: 24px;">
                @yield('content')
            </div>
        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
    <script type="text/javascript">
        $('.hapus_jabatan').click(function(event) {
            var form = $(this).closest("form");
            var nama = $(this).data("nama");
            event.preventDefault();
            swal({
                    title: `Apakah Anda yakin ingin menghapus data jabatan ${nama} ?`,
                    text: `Dengan menekan tombol OK, maka data jabatan ${nama} beserta data karyawan yang punya jabatan ${nama} akan hilang selamanya!`,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });

        $('.hapus_karyawan').click(function(event) {
            var form = $(this).closest("form");
            var nama = $(this).data("nama");
            event.preventDefault();
            swal({
                    title: `Apakah Anda yakin ingin menghapus biodata ${nama} ?`,
                    text: `Dengan menekan tombol OK, maka biodata ${nama} akan hilang selamanya!`,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
    @yield('extra_scripts')
</body>

</html>
