@extends('layouting.auth')

@section('title', 'Events')

@push('headers')
    <link rel="stylesheet" href="{{ asset('assets/auth/css/carousel.css') }}">
@endpush

@section('content')
    <x-card.breadcrumb main="Home" current="Events" route="{{ route('events') }}" />

    <div class="card card-body">
        <div class="row">
            <div class="col-md-4 col-xl-3">
                <x-search.basic placeholder="Events" />
            </div>
        </div>
    </div>

    <div class="card card-body">
        <x-table.basic>
            @slot('slotHead')
                <th class="w-20">Event</th>
                <th>Poster</th>
                <th>Tanggal</th>
                <th>H- Acara</th>
                <th class="text-center">Maksimal Peserta</th>
                <th class="text-center">Jumlah Pendaftar</th>
                <th>Status</th>
            @endslot

            @slot('slotBody')
                @foreach ($events as $item)
                    <tr class="search-items">
                        <td  class="w-20">
                            <span>{{ $item->name }}</span>
                        </td>
                        <td>
                            <span>{{ $item->poster }}</span>
                        </td>
                        <td>
                            <h6>{{ idnDate($item->date) }}</h6>
                            <span>
                                {{ $item->start_time }} -
                                {{ $item->end_time }}
                            </span>
                        </td>
                        <td>
                            <span>H-{{ daysUntilDate($item->date) }} Hari</span>
                        </td>
                        <td class="text-center">
                            <span>{{ $item->max_participants }}</span>
                        </td>
                        <td class="text-center">
                            <span>{{ $item->participants_summary }}</span>
                        </td>
                        <td>
                            <span class="badge {{ $item->status === 'selesai' ? 'bg-info' : 'bg-success' }}">{{ $item->status }}</span>
                        </td>
                    </tr>
                @endforeach
            @endslot
        </x-table.basic>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/auth/js/carousel.js') }}"></script>

    {{-- <script>
        function modalEditCashflow(element) {
            var name = $(element).data('name');
            var value = $(element).data('value');
            var date = $(element).data('date');
            var tipe = $(element).data('tipe');
            var id = $(element).data('id');
            var route = {!! json_encode(route('cashflow.update') . '/') !!} + id

            $("#input-edt_name").val(name)
            $("#input-edt_value").val(value)
            $("#input-edt_date").val(date)
            $("#input-edt_tipe").val(tipe)
            $("#editCashflow form").attr('action', route)

            $("#editCashflow").modal('show')
        }
    </script> --}}
@endpush
