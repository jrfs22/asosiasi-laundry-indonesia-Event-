@extends('layouting.auth')

@section('title', 'Data Absensi')

@push('headers')
    <link rel="stylesheet" href="{{ asset('assets/auth/css/carousel.css') }}">
@endpush

@section('content')
    <x-card.breadcrumb main="Home" current="Data Absensi" route="{{ route('beranda') }}" />

    <div class="row">
        <div class="col-12">
            <div class="card overflow-hidden">
                <div class="d-flex flex-row">
                    <div class="p-4 text-bg-success">
                        <h3 class="text-white box mb-0">
                            <i class="ti ti-users"></i>
                        </h3>
                    </div>
                    <div class="p-3">
                        <h3 class="text-success mb-0 fs-6">{{ $participants->count() }}</h3>
                        <span>Total Peserta yang sudah absen</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-body">
        <x-search.basic placeholder="Absensi" />
    </div>

    <div class="card card-body">
        <x-table.basic>
            @slot('slotHead')
                <th class="text-center">No</th>
                <th>Nama</th>
                <th>Sertifikat</th>
                <th>Absensi</th>
                <th>Jumlah</th>
            @endslot

            @slot('slotBody')
                @foreach ($participants as $key => $item)
                    <tr class="search-items">
                        <td class="text-center">
                            {{ $key + 1 }}
                        </td>
                        <td>
                            <h6>{{ $item->name }}</h6>
                            <span>{{ $item->phone_number }}</span>
                        </td>
                        <td>
                            <span>{{ $item->certificate_name }}</span>
                        </td>
                        <td>
                            <ul>
                                @foreach ($item->attendances as $attendancesItem)
                                    <li class="text-capitalize">
                                        {{ $attendancesItem->type }} :
                                        <b>{{ $attendancesItem->created_at }}</b>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            {{ $item->attendances->count() }}
                            / <b>2</b>
                        </td>
                    </tr>
                @endforeach
            @endslot
        </x-table.basic>
    </div>
@endsection
