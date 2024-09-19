@extends('layouting.auth')

@section('title', 'Scanning')

@push('headers')
    <link rel="stylesheet" href="{{ asset('assets/auth/css/carousel.css') }}">
    <style>
        /* QRCODE Reader */
        #reader {
            width: 400px;
            border-radius: 20px;
        }

        /* Qr Code */
        #reader video {
            border-radius: 20px;
        }

        #reader__scan_region video {
            border-radius: 20px !important;
        }

        #qr-shaded-region {
            border-radius: 20px;
        }

        #html5-qrcode-button-camera-start,
        #html5-qrcode-button-camera-permission {
            background-color: var(--success-color);
            color: #003d75;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        #html5-qrcode-button-camera-stop {
            background-color: var(--success-color);
            color: #003d75;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        #reader__dashboard {
            background-color: #eaeaea;
            border-radius: 0 0 20px 20px;
        }
    </style>
@endpush

@section('content')
    <x-card.breadcrumb main="Home" current="Scanning" route="{{ route('beranda') }}" />

    <div class="card card-body">
        <div class="w-100" id="reader"></div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script>
        let html5QrcodeScannerConfig = {
            fps: 100,
            qrbox: {
                width: 250,
                height: 250
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner('reader', html5QrcodeScannerConfig)

        function onScanSuccess(decodedText) {
            console.log(decodedText);
            stopScanning()
        }


        function onScanError(error) {}

        async function startScanning() {
            try {
                const constraints = {
                    video: {
                        facingMode: 'environment'
                    }
                }

                const stream = await navigator.mediaDevices.getUserMedia(constraints)

                html5QrcodeScanner.render(onScanSuccess, onScanError);
            } catch (error) {
                console.log('asd ', error);
            }
        }

        function stopScanning() {
            html5QrcodeScanner.clear();
        }

        $(document).ready(function() {
            startScanning();
        })
    </script>
@endpush
