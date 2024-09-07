@extends('layouting.auth')

@section('title', 'Pendaftar')

@push('headers')
    <link rel="stylesheet" href="{{ asset('assets/auth/css/carousel.css') }}">
@endpush

@section('content')
    <x-card.breadcrumb main="Home" current="Pendaftar" route="{{ route('registrasi.pendaftar') }}" />

    <div class="card card-body">
        <div class="row">
            <div class="col-md-4 col-xl-3">
                <x-search.basic placeholder="Events" />
            </div>
            <div class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                <x-search.filter>
                    @foreach ($events as $item)
                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                    @endforeach
                </x-search.filter>
            </div>
        </div>
    </div>

    <div class="card card-body">
        <x-table.basic>
            @slot('slotHead')
                <th>Event</th>
                <th class="text-center">Pendaftar</th>
                <th>Jumlah pembayaran</th>
                <th>Diskon</th>
                <th>Status</th>
            @endslot

            @slot('slotBody')
                @foreach ($pendaftar as $item)
                    <tr class="search-items {{ $item->event->name }}">
                        <td>
                            <span>{{ $item->event->name }}</span>
                        </td>
                        <td class="text-center">
                            <span >{{ $item->tickets }}</span>
                        </td>
                        <td>
                            <span>{{ idrFormat($item->amount) }}</span>
                        </td>
                        <td>
                            <span>{{ idrFormat($item->discount) }}</span>
                        </td>
                        <td>
                            <span class="badge {{ $item->payment_status == 'selesai' ? 'bg-success' : 'bg-warning' }}">{{ $item->payment_status }}</span>
                        </td>
                    </tr>
                @endforeach
            @endslot
        </x-table.basic>
    </div>
@endsection
