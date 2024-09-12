@extends('layouting.auth')

@section('title', 'Pendaftar')

@push('headers')
    <link rel="stylesheet" href="{{ asset('assets/auth/css/carousel.css') }}">
@endpush

@section('content')
    <x-card.breadcrumb main="Home" current="Pendaftar" route="{{ route('pendaftar') }}" />

    <div class="row">
        <div class="col-12 col-md-4 col-xl-3">
            <div class="card overflow-hidden">
                <div class="d-flex flex-row">
                    <div class="p-4 text-bg-success">
                        <h3 class="text-white box mb-0">
                            <i class="ti ti-ticket"></i>
                        </h3>
                    </div>
                    <div class="p-3">
                        <h3 class="text-success mb-0 fs-6">{{ $tickets['totalPaid'] }}</h3>
                        <span>Total tiket lunas</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 col-xl-3">
            <div class="card overflow-hidden">
                <div class="d-flex flex-row">
                    <div class="p-4 text-bg-danger">
                        <h3 class="text-white box mb-0">
                            <i class="ti ti-ticket"></i>
                        </h3>
                    </div>
                    <div class="p-3">
                        <h3 class="text-danger mb-0 fs-6">{{ $tickets['totalUnpaid'] }}</h3>
                        <span>Total tiket belum bayar</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 col-xl-3">
            <div class="card overflow-hidden">
                <div class="d-flex flex-row">
                    <div class="p-4 text-bg-success">
                        <h3 class="text-white box mb-0">
                            <i class="ti ti-currency-dollar"></i>
                        </h3>
                    </div>
                    <div class="p-3">
                        <h3 class="text-success mb-0 fs-6">{{ idrFormat($tickets['totalSettled']) }}</h3>
                        <span>Pembayaran lunas</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 col-xl-3">
            <div class="card overflow-hidden">
                <div class="d-flex flex-row">
                    <div class="p-4 text-bg-danger">
                        <h3 class="text-white box mb-0">
                            <i class="ti ti-currency-dollar"></i>
                        </h3>
                    </div>
                    <div class="p-3">
                        <h3 class="text-danger mb-0 fs-6">{{ idrFormat($tickets['totalPending']) }}</h3>
                        <span>Pembayaran pending</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-body">
        <div class="row">
            <div class="col-md-4 col-xl-3">
                <x-search.basic placeholder="Pendaftar" />
            </div>
            <div class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0 gap-2">
                @can('reminder pembayaran')
                    <a href="{{ route('pendaftar.reminder-pembayaran') }}" id="btnReminder"
                        class="btn btn-warning text-capitalize fs-4">
                        Reminder pembayaran
                    </a>
                @endcan

                <a target="_blank" href="{{ route('pendaftar.download') }}" class="btn btn-success fs-3 fw-bold">
                    <i class="ti ti-file-spreadsheet"></i>
                    Download
                </a>
            </div>
        </div>
    </div>

    <div class="card card-body">
        <x-table.basic>
            @slot('slotHead')
                {{-- <th class="w-20">Acara</th> --}}
                <th>Pendaftar</th>
                <th>Pembayaran</th>
                <th>Bukti pembayaran</th>
                <th>Status</th>
                <th>Aksi</th>
            @endslot

            @slot('slotBody')
                @foreach ($pendaftar as $item)
                    <tr class="search-items {{ $item->event->name }}">
                        {{-- <td class="w-20">
                            <span>{{ $item->event->name }}</span>
                        </td> --}}
                        <td>
                            <div>
                                <h6>{{ $item->name }} <b>({{ $item->member == 'ya' ? 'Member' : 'Non Member' }})</b></h6>
                                <span>Hp/Wa : {{ $item->phone_number }}</span>
                            </div>
                        </td>
                        <td>
                            <div>
                                <h6>Tiket: {{ $item->tickets }}</h6>
                                <h6>Total: {{ idrFormat($item->amount) }}</h6>
                                <span class="fs-3">
                                    Diskon: {{ idrFormat($item->discount_total) }}
                                    <b>({{ $item->discount_percentage }}%)</b>
                                </span>
                            </div>
                        </td>
                        <td>
                            <img src="{{ asset('storage/' . $item->bukti_pembayaran) }}" alt="Bukti pembayaran" width="150"
                                height="200">
                        </td>
                        <td>
                            <span
                                class="badge {{ $item->payment_status === 'lunas' ? 'bg-success' : 'bg-info' }}">{{ $item->payment_status }}</span>
                        </td>
                        <td>
                            @if ($item->payment_status === 'lunas')
                                -
                            @else
                                <a href="#" class="text-capitalize fs-4"
                                    onclick="showModal('{{ route('pendaftar.update', ['id' => $item->id]) }}')">
                                    Verifikasi
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
            <x-forms.input2 label="Bukti pembayaran" name="bukti_pembayaran" placeholder="Masukkan bukti pembayaran"
                type="File" />
        </div>
    </x-modal.basic>
@endsection

@push('scripts')
    <script>
        function showModal(route) {
            $('#defaultModal').modal('show');
            $("#defaultModal form").attr('action', route)
        }

        $("#btnReminder").on('click', function(e) {
            e.preventDefault();

            var href = $(this).attr('href');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan mengirimkan reminder pembayaran.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, kirim!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });

            $(this).attr('href');
        })
    </script>
@endpush
