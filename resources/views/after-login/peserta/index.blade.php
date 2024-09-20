@extends('layouting.auth')

@section('title', 'Daftar Peserta')

@section('content')
    <x-card.breadcrumb main="Home" current="Daftar Peserta" route="{{ route('qrcode') }}" />

    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card overflow-hidden">
                <div class="d-flex flex-row">
                    <div class="p-4 text-bg-success">
                        <h3 class="text-white box mb-0">
                            <i class="ti ti-users"></i>
                        </h3>
                    </div>
                    <div class="p-3">
                        <h3 class="text-success mb-0 fs-6">{{ $qrcode['has'] }}</h3>
                        <span>Total peserta memiliki QR Code</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card overflow-hidden">
                <div class="d-flex flex-row">
                    <div class="p-4 text-bg-danger">
                        <h3 class="text-white box mb-0">
                            <i class="ti ti-users"></i>
                        </h3>
                    </div>
                    <div class="p-3">
                        <h3 class="text-danger mb-0 fs-6">{{ $qrcode['doesnt'] }}</h3>
                        <span>Total peserta belum memiliki QR Code</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-body">
        <div class="row">
            <div class="col-12 col-lg-4">
                <x-search.basic placeholder="Peserta" />
            </div>
            <div class="col-12 col-lg-8 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0 gap-2">
                @can('reminder acara')
                    @if ($reminder['exist'])
                        <a href="{{ route('pendaftar.reminder-acara') }}" id="btnReminder"
                            class="btn btn-warning text-capitalize fs-4">
                            Reminder Acara H-{{ $reminder['days'] }}
                        </a>
                    @endif
                @endcan

                <a target="_blank" href="{{ route('pendaftar.download') }}" class="btn btn-success fs-3 fw-bold">
                    <i class="ti ti-file-spreadsheet"></i>
                    Download
                </a>

                <x-search.filter>
                    <option value="member">Member</option>
                    <option value="non member">Non Member</option>
                </x-search.filter>

            </div>
        </div>
    </div>

    <div class="card card-body">
        <x-table.basic>
            @slot('slotHead')
                {{-- <th class="w-20">Event</th> --}}
                <th>Nama</th>
                <th>Laundry</th>
                <th>Sertifikat</th>
                <th>QR Code</th>
                <th>Jabatan</th>
            @endslot

            @slot('slotBody')
                @foreach ($participants as $item)
                    <tr class="search-items {{ $item->type }}">
                        <td>
                            <h6>{{ $item->name }}</h6>
                            <span>{{ $item->phone_number }}</span>
                        </td>
                        <td>
                            <span>{{ $item->laundry_name }}</span>
                        </td>
                        <td>
                            <span>{{ $item->certificate_name }}</span>
                        </td>
                        <td>
                            <img src="{{ asset('storage/qrcodes/' . $item->qrcode) }}" alt="QR Code {{ $item->name }}"
                                width="100" height="100">
                        </td>
                        <td>
                            <span class="text-capitalize">{{ $item->type }}</span>
                        </td>
                    </tr>
                @endforeach
            @endslot
        </x-table.basic>
    </div>

    <x-loading message="Sedang mengirimkan pesan whatsapp, mohon tidak menutup aplikasi ini." />
@endsection

@push('scripts')
    <script>
        $("#btnReminder").on('click', function(e) {
            e.preventDefault();

            var href = $(this).attr('href');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan mengirimkan reminder acara.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, kirim!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#loading").css("display", "flex");
                    window.location.href = href;
                }
            });

            $(this).attr('href');
        })
    </script>
@endpush
