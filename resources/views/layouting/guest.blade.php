<!doctype html>
<html lang="en">

<head>
    @include('layouting._partials.header')
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">

        @yield('content')
    </div>

    @include('layouting._partials.scripts')

</body>

</html>
