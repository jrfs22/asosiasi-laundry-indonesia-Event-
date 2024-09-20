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
        <div class="row">
            <div class="col-12 col-md-3">
                <x-search.basic placeholder="Absensi" />
            </div>
            <div class="col-12 col-md-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0 gap-2">
                <a target="_blank" href="{{ route('absensi.download') }}" class="btn btn-success fs-3 fw-bold">
                    <i class="ti ti-file-spreadsheet"></i>
                    Download
                </a>

                @can('scan absensi')
                    <div class="btn-group">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti ti-plus"></i>
                            Absensi
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item" href="{{ route('scan', ['type' => 'kehadiran']) }}">Kehadiran</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('scan', ['type' => 'konsumsi']) }}">Konsumsi</a>
                            </li>
                        </ul>
                    </div>
                @endcan
            </div>
        </div>
    </div>

    <div class="card card-body">
        <x-table.basic>
            @slot('slotHead')
                <th class="text-center">No</th>
                <th>Nama</th>
                <th>Sertifikat</th>
                <th>Absensi</th>
                <th>Jumlah</th>
                @can('delete absensi')
                    <th>Aksi</th>
                @endcan
            @endslot

            @slot('slotBody')
                @foreach ($participants as $key => $item)
                    <tr class="search-items">
                        <td class="text-center">
                            {{ $key + 1 }}
                        </td>
                        <td>
                            <h6 class="text-capitalize">{{ $item->name }}</h6>
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
                        @can('delete absensi')
                            <td>
                                <div class="action-btn d-flex">
                                    <x-card.deleted
                                        route="{{ route('absensi.destroy', [
                                            'event_id' => $item->event_id,
                                            'participant_id' => $item->id,
                                            'registration_id' => $item->registration_id,
                                        ]) }}" />
                                </div>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            @endslot
        </x-table.basic>
    </div>
@endsection
