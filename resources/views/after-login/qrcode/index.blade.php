@extends('layouting.auth')

@section('title', 'Peserta')

@push('headers')
    <link rel="stylesheet" href="{{ asset('assets/auth/css/carousel.css') }}">
@endpush

@section('content')
    <x-card.breadcrumb main="Home" current="Absensi" route="{{ route('peserta') }}" />

    <div class="card card-body">
        <div class="row">
            <div class="col-md-4 col-xl-3">
                <x-search.basic placeholder="Members" />
            </div>
            <div class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                <a target="_blank" href="{{ route('qrcode.download') }}" class="btn btn-success fs-3 fw-bold">
                    <i class="ti ti-file-spreadsheet"></i>
                    Download
                </a>
            </div>
        </div>
    </div>

    <div class="card card-body">
        <x-table.basic>
            @slot('slotHead')
                {{-- <th class="w-20">Event</th> --}}
                <th>Nama</th>
                <th>QR Code Data</th>
                <th>QR Code</th>
            @endslot

            @slot('slotBody')
                @foreach ($participants as $item)
                    <tr class="search-items">
                        <td>
                            <h6>{{ $item->name }}</h6>
                            <span>{{ $item->phone_number }}</span>
                        </td>
                        <td>
                            <span>{{ formatString($item->name) }} / {{ $item->registration_id }}</span>
                        </td>
                        <td>
                            <img src="{{ asset('storage/qrcodes/' . $item->qrcode) }}" alt="QR Code {{ $item->name }}" width="100" height="100">
                        </td>
                    </tr>
                @endforeach
            @endslot
        </x-table.basic>
    </div>
@endsection
