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
</body>

</html>
