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
            requestData(decodedText)
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

        function requestData(data) {
            var route = {!! json_encode(route('absensi.validate')) !!} + '/' + data

            $.ajax({
                url: route,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var terdaftar = response.terdaftar
                    var insert = response.insert

                    if (terdaftar) {
                        var name = response.name.toUpperCase()
                        if (insert) {
                            sweetAlert(
                                "QR Code Valid",
                                name + " berhasil di daftarkan, silahkan berikan konsumsinya",
                                "success"
                            );
                        } else {
                            sweetAlert(
                                "QR Code Valid",
                                name + " sudah mengambil konsumsi",
                                "error"
                            );
                        }
                    } else {
                        if (insert) {} else {
                            sweetAlert(
                                "QR Code Invalid",
                                "QR Code Tidak terdaftar",
                                "error"
                            );
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            })
        }

        function sweetAlert(title, text, icon) {
            Swal.fire({
                title: title,
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Cek Lagi?",
                cancelButtonText: "Cek data absensi"
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload()
                } else {
                    location.href = {!! json_encode(route('absensi')) !!}
                }
            });
        }

        $(document).ready(function() {
            startScanning();
        })
    </script>
@endpush
