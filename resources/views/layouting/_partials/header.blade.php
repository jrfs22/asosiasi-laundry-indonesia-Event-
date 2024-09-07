@include('layouting._partials.meta')

<link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/customs.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/css/libs/dataTable.css') }}" />

<link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

@vite('resources/css/app.css')

@stack('headers')
