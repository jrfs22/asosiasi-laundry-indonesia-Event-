@extends('layouting.guest')

@section('title', 'Beranda')

@push('headers')
    <style>
        body {
            background: url('/assets/images/backgrounds/custom.png');
            background-size: cover;
        }
    </style>
@endpush

@section('content')
    <div class="container-beranda">
        <nav class="navbar">
            <a class="navbar-brand d-flex gap-3 align-items-center" href="#">
                <img src="{{ asset('assets/logo/asli-circle.png') }}" alt="Logo {{ config('app.name') }}" width="122"
                    height="122">

                <div class="company-name">
                    ASLI <br>
                    DPD RIAU
                </div>
            </a>
        </nav>

        <div class="beranda">
            <div class="row">
                <div class="col-12 col-md-5 left animate__animated animate__fadeInLeft">
                    <div class="content">
                        <h1>Selamat datang di halaman registrasi Workshop.</h1>
                        <p class="tagline">Amankan kursi anda, upgrade dan scale up bisnis anda</p>

                        <a href="{{ route('registrasi') }}" class="btn btn-primary w-100" id="btn-registrasi">Registrasi
                            Sekarang</a>

                        <p class="warning">
                            *Peserta terbatas
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-7 right animate__animated animate__fadeInRight overflow-hidden">
                    <div class="hitung-mundur">
                        <p class="highlight">Hitung Mundur Acara:</p>
                        <div class="row gx-2 gx-sm-3 gx-md-4">
                            <div class="col-3 col-md-6 col-lg-3 h-100">
                                <div class="card">
                                    <span>Hari</span>
                                    <h5 id="days">48</h5>
                                </div>
                            </div>
                            <div class="col-3 col-md-6 col-lg-3 h-100">
                                <div class="card">
                                    <span>Jam</span>
                                    <h5 id="hours">48</h5>
                                </div>
                            </div>
                            <div class="col-3 col-md-6 col-lg-3 h-100">
                                <div class="card">
                                    <span>Menit</span>
                                    <h5 id="minutes">48</h5>
                                </div>
                            </div>
                            <div class="col-3 col-md-6 col-lg-3 h-100">
                                <div class="card">
                                    <span>Detik</span>
                                    <h5 id="seconds">48</h5>
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="card peserta">
                                    <span>PENDAFTAR</span>
                                    <h5>{{ ($event->summary + 0) }}</h5>
                                </div>
                            </div>
                            <div class="col-6 col-md-6">
                                <div class="card peserta">
                                    <span>TERSEDIA</span>
                                    <h5>{{ ($event->max_participants - $event->summary - 0) }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card poster">
            <img src="{{ asset('assets/images/posters/revisi-terakhir.jpg') }}" alt="Poster acara" width="100%">
        </div>

        <footer>
            Powered by
            <img src="{{ asset('assets/images/logo/zalamobile.png') }}" alt="Logo zala mobile">
        </footer>
    </div>
@endsection

@push('scripts')
    <script>
        var gap = {!! $event->max_participants - $event->summary !!}

        if (gap === 0) {
            $("#btn-registrasi").addClass('disabled');
        }

        document.addEventListener('DOMContentLoaded', function() {
            var countDownDate = new Date("Sep 28, 2024 08:00:00").getTime();

            var countdownFunction = setInterval(function() {
                var now = new Date().getTime();

                var distance = countDownDate - now;

                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                $("#days").text(days)
                $("#hours").text(hours)
                $("#minutes").text(minutes)
                $("#seconds").text(seconds)

                if (distance < 0) {
                    clearInterval(countdownFunction);
                    $("#days").text("0")
                    $("#hours").text("0")
                    $("#minutes").text("0")
                    $("#seconds").text("0")
                    $("#btn-registrasi").addClass('disabled');
                }
            }, 1000);


        });
    </script>
@endpush
