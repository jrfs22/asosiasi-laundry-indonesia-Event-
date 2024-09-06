<!doctype html>
<html lang="en">

<head>
    @include('layouting._partials.header')
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        @include('layouting._partials.sidebar')
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('layouting._partials.navbar')
            <!--  Header End -->
            <div class="container-fluid">
                <!--  Row 1 -->

                @yield('content')

                {{-- Footer --}}
                @include('layouting._partials.footer')

            </div>
        </div>
    </div>

    @include('layouting._partials.scripts')

</body>

</html>
