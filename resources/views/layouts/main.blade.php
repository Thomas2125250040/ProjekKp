<!doctype html>
<html lang="en">

@include('layouts.head')

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
    @include('layouts.scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.hapus_jabatan').click(function(event) {
            var form = $(this).closest("form");
            var nama = $(this).data("nama");
            event.preventDefault();
            swal({
                    title: `Apakah Anda yakin ingin menghapus data Jabatan ${nama} ?`,
                    text: `Dengan menekan tombol OK, maka data Jabatan ${nama} beserta data Karyawan yang punya Jabatan ${nama} akan hilang selamanya!`,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
            //     const swalWithBootstrapButtons = Swal.mixin({
            //         customClass: {
            //             confirmButton: "btn btn-success",
            //             cancelButton: "btn btn-danger"
            //         },
            //         buttonsStyling: false
            //     });
            //     swalWithBootstrapButtons.fire({
            //         title: `Apakah Anda yakin ingin menghapus data jabatan ${nama} ini?`,
            //         text: `Dengan menekan tombol hapus, maka data jabatan ${nama} akan hilang selamanya`,
            //         icon: "warning",
            //         showCancelButton: true,
            //         confirmButtonText: "Hapus",
            //         cancelButtonText: "Tidak",
            //         reverseButtons: true
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             swalWithBootstrapButtons.fire({
            //                 title: "Berhasil!",
            //                 text: `Data ${nama} telah dihapus`,
            //                 icon: "success",
            //             }).then(() => {
            //                 form.submit();
            //             });
            //         } else if (
            //             /* Read more about handling dismissals below */
            //             result.dismiss === Swal.DismissReason.cancel
            //         ) {
            //             swalWithBootstrapButtons.fire({
            //                 title: "Gagal",
            //                 text: `Data ${nama} tidak jadi dihapus` ,
            //                 icon: "error"
            //             });
            //         }
            //     });

        });

        // $('.tambah_jabatan').click(function(event) {
        //     event.preventDefault();
        //     swal.fire({
        //         icon: "success",
        //         title: "Jabatan berhasil ditambah",
        //         showConfirmButton: false,
        //         timer: 1500
        //     })
        // });

        $('.hapus_karyawan').click(function(event) {
            var form = $(this).closest("form");
            var nama = $(this).data("nama");
            event.preventDefault();
            swal({
                    title: `Apakah Anda yakin ingin menghapus Biodata ${nama} ?`,
                    text: `Dengan menekan tombol OK, maka Biodata ${nama} akan hilang selamanya!`,
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
</body>


</html>
