@extends('layouting.auth')

@section('title', 'Pendaftar')

@push('headers')
    <link rel="stylesheet" href="{{ asset('assets/auth/css/carousel.css') }}">
@endpush

@section('content')
    <x-card.breadcrumb main="Home" current="Pendaftar" route="{{ route('pendaftar') }}" />

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
                <th>Acara</th>
                <th>Pendaftar</th>
                <th>Pembayaran</th>
                <th>Nomor HP</th>
                <th>Status pembayaran</th>
            @endslot

            @slot('slotBody')
                @foreach ($pendaftar as $item)
                    <tr class="search-items {{ $item->event->name }}">
                        <td>
                            <span>{{ $item->event->name }}</span>
                        </td>
                        <td>
                            <div>
                                <h6>{{ $item->name }} <b>({{ $item->member == 'ya' ? 'Member' : 'Non Member' }})</b></h6>
                                <span>Hp/Wa : {{ $item->phone_number }}</span>
                            </div>
                        </td>
                        <td>
                            <div>
                                <h6>Total: {{ idrFormat($item->amount) }}</h6>
                                <span class="fs-3">
                                    Diskon: {{ idrFormat($item->discount_total) }}
                                    <b>({{ $item->discount_percentage }}%)</b>
                                </span>
                            </div>
                        </td>
                        <td>
                            <span>{{ $item->phone_number }}</span>
                        </td>
                        <td>
                            <span>{{ $item->payment_status }}</span>
                        </td>
                    </tr>
                @endforeach
            @endslot
        </x-table.basic>
    </div>
@endsection
