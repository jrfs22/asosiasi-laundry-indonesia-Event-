@extends('layouting.auth')

@section('title', 'Reward')

@push('headers')
    <link rel="stylesheet" href="{{ asset('assets/auth/css/carousel.css') }}">
@endpush

@section('content')
    <x-card.breadcrumb main="Home" current="Reward" route="{{ route('reward') }}" />

    <div class="row">
        <div class="col-6">
            <div class="card overflow-hidden">
                <div class="d-flex flex-row">
                    <div class="p-4 text-bg-info">
                        <h3 class="text-white box mb-0">
                            <i class="ti ti-trophy"></i>
                        </h3>
                    </div>
                    <div class="p-3">
                        <h3 class="text-success mb-0 fs-6">{{ $reward->total_points }}</h3>
                        <span>Point</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card overflow-hidden">
                <div class="d-flex flex-row">
                    <div class="p-4 text-bg-success">
                        <h3 class="text-white box mb-0">
                            <i class="ti ti-users"></i>
                        </h3>
                    </div>
                    <div class="p-3">
                        <h3 class="text-danger mb-0 fs-6">{{ $reward->referral_summary }}</h3>
                        <span>Referred</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-body">
        <div class="row">
            <div class="col-md-4 col-xl-3">
                <x-search.basic placeholder="Referer" />
            </div>
        </div>
    </div>

    <div class="card card-body">
        <x-table.basic>
            @slot('slotHead')
                <th>Nama</th>
                <th>Poin</th>
                <th>Tanggal</th>
            @endslot

            @slot('slotBody')
                @foreach ($reward->history as $item)
                <tr class="search-items income">
                    <td>
                        <div class="user-meta-info">
                            <h6>{{ $item->referral->user->name }}</h6>
                            <span>{{ $item->referral->user->email }}</span>
                        </div>
                    </td>
                    <td>
                        <span>{{ $item->referral->points }}</span>
                    </td>
                    <td>
                        <span>{{ idnDate($item->referral->created_at) }}</span>
                    </td>
                </tr>
                @endforeach
            @endslot
        </x-table.basic>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/auth/js/carousel.js') }}"></script>

    <script>
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
    </script>
@endpush
