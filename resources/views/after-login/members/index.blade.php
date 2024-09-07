@extends('layouting.auth')

@section('title', 'Member')

@push('headers')
    <link rel="stylesheet" href="{{ asset('assets/auth/css/carousel.css') }}">
@endpush

@section('content')
    <x-card.breadcrumb main="Home" current="Member" route="{{ route('member') }}" />

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
                <th>Nama</th>
                <th>No HP</th>
                <th>Jabatan</th>
            @endslot

            @slot('slotBody')
                @foreach ($members as $item)
                    <tr class="search-items {{ $item->type }}">
                        <td>
                            <span>{{ $item->name }}</span>
                        </td>
                        <td>
                            <span>{{ $item->phone_number }}</span>
                        </td>
                        <td>
                            <span class="text-capitalize">{{ $item->type }}</span>
                        </td>
                    </tr>
                @endforeach
            @endslot
        </x-table.basic>
    </div>
@endsection
