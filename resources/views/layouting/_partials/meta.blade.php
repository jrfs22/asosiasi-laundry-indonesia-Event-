<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{ asset('assets/logo/ms-icon-144x144.png') }}">
<meta name="theme-color" content="#ffffff">

<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/logo/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/logo/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/logo/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('assets/logo/site.webmanifest') }}">


<title>@yield('title') | {{ env('APP_NAME') }} </title>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@vite('resources/css/app.css')
