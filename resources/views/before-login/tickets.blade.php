@extends('layouting.guest')

@section('title', 'Registrasi Workshop')

@push('headers')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background: url('/assets/images/backgrounds/custom-2.png');
            background-size: cover;
        }
    </style>
@endpush

@section('content')

<div class="registration tickets d-flex flex-column align-items-center justify-content-center mt-4 mb-4">
    <div class="card wizard-form animate__animated animate__fadeInDown">
        <div class="header">
            <h5 class="text-center">Pemesanan</h5>
            <p class="text-center">Selamat! tiket anda berhasil diproses</p>
        </div>
        <div class="row">
            <div class="col-5">
                <img id="qrcode" src="{{ asset('storage/qrcodes/s.svg') }}" alt="QR Code" width="214" height="214">
            </div>
            <div class="col-7 detail">
                <div>Tanggal Pemesanan: 7 September 2024</div>
                <div>Pemesanan atas nama: Adi Laundry</div>
                <div>No HP: 08123456781</div>
                <div>Metode pembayaran: Transfer Rek BCA</div>
                <div>Status pembayaran: <span style="color: red">LUNAS</span></div>
            </div>
        </div>
    </div>

    <footer>
        Powered by
        <img src="{{ asset('assets/images/logo/zalamobile.png') }}" alt="Logo zala mobile">
    </footer>
</div>


@endsection
