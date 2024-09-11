@extends('layouting.auth')

@section('title', 'Peserta')

@push('headers')
    <link rel="stylesheet" href="{{ asset('assets/auth/css/carousel.css') }}">
@endpush

@section('content')
    <x-card.breadcrumb main="Home" current="Absensi" route="{{ route('peserta') }}" />

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
            <div class="col-md-4 col-xl-3">
                <x-search.basic placeholder="Members" />
            </div>
            <div class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                <x-search.filter>
                    <option value="member">Member</option>
                    <option value="panitia">Panitia</option>
                    <option value="pengurus">Pengurus</option>
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
                <th>Status</th>
            @endslot

            @slot('slotBody')
                @foreach ($participants as $item)
                    <tr class="search-items {{ $item->type }}">
                        {{-- <td class="w-20">
                            <span>{{ $item->event->name }}</span>
                        </td> --}}
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
                            <img src="{{ asset('storage/qrcodes/' . $item->qrcode) }}" alt="QR Code {{ $item->name }}" width="100" height="100">
                        </td>
                        <td>
                            <span class="text-capitalize">{{ $item->type }}</span>
                        </td>
                        <td>
                            <span class="text-capitalize">hadir</span>
                        </td>
                    </tr>
                @endforeach
            @endslot
        </x-table.basic>
    </div>
@endsection
