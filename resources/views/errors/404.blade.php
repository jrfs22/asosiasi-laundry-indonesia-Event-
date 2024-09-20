@extends('layouting.guest')

@section('title', 'Not Found Page')

@push('headers')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background: url('/assets/images/backgrounds/custom-2.png');
            background-size: cover;
            width: 100vw;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush

@section('content')

    <div class="close-registration d-flex flex-column align-items-center justify-content-center">
        <div class="card card-body">
            <div class="text-center">
                <h1>PAGE NOT FOUND</h1>
                <p>MAAF, Kami tidak menemukan halaman yang dituju</p>
                <img class="close-img" src="{{ asset('assets/images/svg/sorry-hand.svg') }}" width="203" height="237"
                    alt="Icon close registration">
                    <a class="btn btn-primary w-100" href="{{ route('beranda') }}">Beranda</a>
            </div>
            <footer>
                Powered by
                <img src="{{ asset('assets/images/logo/zalamobile.png') }}" alt="Logo zala mobile">
            </footer>
        </div>
    </div>


@endsection
