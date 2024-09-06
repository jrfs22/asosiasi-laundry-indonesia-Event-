@extends('layouting.guest')

@section('title', 'Login')

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
        <nav class="navbar" style="margin-top: 80px;">
            <a class="navbar-brand d-flex gap-3 align-items-center" href="#">
                <img src="{{ asset('assets/logo/asli-circle.png') }}" alt="Logo {{ config('app.name') }}" width="122"
                    height="122">

                <div class="company-name">
                    Asosiasi
                    Laundry
                    Indonesia
                </div>
            </a>
        </nav>

        <section class="beranda">
            <div class="row">
                <div class="col-5 left">
                    <div class="content">
                        <h1>Selamat datang di halaman registrasi Workshop.</h1>
                        <p class="tagline">Amankan kursi anda, upgrade dan scale up bisnis anda</p>

                        <button class="btn btn-primary w-100">Registrasi Sekarang</button>

                        <p class="warning">
                            *Peserta terbatas
                        </p>
                    </div>
                </div>
                <div class="col-7 right">
                    <div class="hitung-mundur">
                        <p class="highlight">Hitung Mundur Acara:</p>
                        <div class="row">
                            <div class="col-3">
                                <div class="card">
                                    <span>Hari</span>
                                    <h5>48</h5>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <span>Jam</span>
                                    <h5>48</h5>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <span>Menit</span>
                                    <h5>48</h5>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="card">
                                    <span>Detik</span>
                                    <h5>48</h5>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card peserta">
                                    <span>PENDAFTAR</span>
                                    <h5>25</h5>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card peserta">
                                    <span>TERSEDIA</span>
                                    <h5>25</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
