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
                <th class="w-20">Acara</th>
                <th>Pendaftar</th>
                <th>Pembayaran</th>
                <th>Nomor HP</th>
                <th>Bukti pembayaran</th>
                <th>Status</th>
                <th>Aksi</th>
            @endslot

            @slot('slotBody')
                @foreach ($pendaftar as $item)
                    <tr class="search-items {{ $item->event->name }}">
                        <td class="w-20">
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
                            <img src="{{ asset('storage/' . $item->bukti_pembayaran) }}" alt="Bukti pembayaran"
                            width="150" height="200">
                        </td>
                        <td>
                            <span class="badge {{ $item->payment_status === 'lunas' ? 'bg-success' : 'bg-info' }}">{{ $item->payment_status }}</span>
                        </td>
                        <td>
                            @if ($item->payment_status === 'lunas')
                                -
                            @else
                                <a href="#" class="btn-verify"
                                onclick="showModal('{{ route('pendaftar.update', ['id' => $item->id]) }}')">
                                    <i class="ti ti-square-check"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endslot
        </x-table.basic>
    </div>

    <x-modal.basic title="Verifikasi pembayaran" isUpdate=1>
        <div class="mb-3">
            <x-forms.input2
                label="Bukti pembayaran"
                name="bukti_pembayaran"
                placeholder="Masukkan bukti pembayaran"
                type="File"
            />
        </div>
    </x-modal.basic>
@endsection

@push('scripts')
    <script>
        function showModal(route)
        {
            $('#defaultModal').modal('show');
            $("#defaultModal form").attr('action', route)
        }
    </script>
@endpush
