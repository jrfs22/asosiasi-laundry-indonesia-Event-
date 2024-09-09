@extends('layouting.guest')

@section('title', 'Registrasi Workshop')

@push('headers')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background: url('/assets/images/backgrounds/custom-2.png');
            background-size: cover;
        }
    </style>
@endpush

@section('content')

    <div class="registration d-flex flex-column align-items-center justify-content-center mt-4 mb-4">
        <div class="card wizard-form animate__animated animate__fadeInDown">
            <div class="container">
                <form action="{{ route('registrasi.store') }}" method="POST" class="f1">
                    @csrf
                    <h4>Registrasi Workshop</h4>
                    <div class="f1-steps mb-3">
                        <div class="f1-progress">
                            <div class="f1-progress-line" data-now-value="33.3" data-number-of-steps="3"
                                style="width: 33.3%;">
                            </div>
                        </div>
                        <div class="f1-step active">
                            <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                            <p>Data diri</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon"><i class="fa fa-list"></i></div>
                            <p>Peserta</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon"><i class="fa fa-credit-card"></i></div>
                            <p>Pembayaran</p>
                        </div>
                    </div>
                    <fieldset>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <x-forms.input2 name="name" label="Nama Lengkap" placeholder="Adi Sucipto" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <x-forms.input2 name="laundry" label="Nama Laundry" placeholder="Adi Laundry" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <x-forms.input2 name="phone_number" label="Nomor Telepon" placeholder="0812345678" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <x-forms.input2 name="email" label="Alamat Email (jika ada)" placeholder="email@email.com"
                                    required=0 />
                            </div>
                            <div id="member-container">

                            </div>
                            <div class="col-md-12 mb-3">
                                <x-forms.select name="source" label="Tahu tentang acara ini dari mana?">
                                    <option value="teman">Teman</option>
                                    <option value="instagram">Instagram</option>
                                    <option value="facebook">Facebook</option>
                                    <option value="komunitas">Komunitas</option>
                                    <option value="brosur">Brosur</option>
                                </x-forms.select>
                            </div>
                        </div>
                        <div class="f1-buttons">
                            <button type="button" class="btn btn-primary btn-next w-100">Selanjutnya <i
                                    class="fa fa-arrow-right"></i></button>
                        </div>
                    </fieldset>
                    <!-- step 2 -->
                    <fieldset>
                        <div class="row">
                            <label class="form-label">Jumlah tiket</label>
                            <div class="col-md-3 mb-3">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <button type="button" class="btn btn-primary btn-number minus" disabled="disabled"
                                            data-type="minus" data-field="quant[1]">
                                            <span class="fa fa-minus"></span>
                                        </button>
                                    </span>
                                    <input type="text" name="quant[1]" class="form-control input-number" value="1"
                                        min="1" max="10" readonly>
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-primary btn-number plus" data-type="plus"
                                            data-field="quant[1]">
                                            <span class="fa fa-plus"></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-9 mb-3">
                                <p class="warning-text"><b>Note: </b> Pada saat pengisian form Detail Peserta, jika anda
                                    seorang member maka pastikan hanya terdapat 1 Member untuk pemesanan lebih dari 1 tiket.
                                </p>
                            </div>
                            <div class="repeater-container">
                                <div class="col-md-12 mb-3 repeater-form">
                                    <div class="row mt-3">
                                        <div class="col-md-12 mb-3">
                                            <h5>Peserta 1</h5>
                                        </div>
                                        <div class="col-md-7 mb-3" id="firstName">
                                            <x-forms.input2 name="nameArr[]" label="Nama" placeholder="Adi Sucipto"
                                                readonly=1 />
                                        </div>
                                        <div class="col-md-5 mb-3" id="firstPhoneNumber">
                                            <x-forms.input2 name="phone_number_arr[]" label="Nomor telepon"
                                                placeholder="0812345678" readonly=1 />
                                        </div>
                                        <div class="col-md-5 mb-3" id="firstLaundry">
                                            <x-forms.input2 name="laundry_arr[]" label="Nama laundry (Jika ada)"
                                                placeholder="Adi laundry keren" required=0 readonly=1 />
                                        </div>
                                        <div class="col-md-7 mb-3">
                                            <x-forms.input2 name="certificate[]" label="Nama pada sertifikat"
                                                placeholder="Adi laundry keren" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="f1-buttons">
                            <button type="button" class="btn btn-warning btn-previous w-100">
                                <i class="fa fa-arrow-left"></i>
                                Sebelumnya
                            </button>
                            <button type="button" class="btn btn-primary btn-next w-100 mt-2" id="checkTotal">
                                Selanjutnya <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>
                    </fieldset>
                    <!-- step 3 -->
                    <fieldset>
                        <div class="payment">
                            <h5>Pemesanan</h5>
                            <p class="subtitle">{{ now() }}</p>
                            <div class="table-responsive mb-4 border rounded-1">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead>
                                        <th>Nama pemesan</th>
                                        <th>Member</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="tbl_pemesan">Supriadi</td>
                                            <td id="tbl_isMember">Ya</td>
                                            <td id="tbl_tickets">4</td>
                                            <td id="tbl_total">Rp 1.000.000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="total-container">
                                <div class="detail">
                                    <div class="left">Subtotal</div>
                                    <div class="right" id="subtotal">Rp 1.000.000</div>
                                </div>
                                <div class="detail">
                                    <div class="left" id="diskon">Diskon (30%)</div>
                                    <div class="right" id="totalDiskon">Rp 300.000</div>
                                </div>
                                <div class="line"></div>
                                <div class="detail">
                                    <div class="left">Harga Total</div>
                                    <div class="right" id="hargaTotal">Rp 700.000</div>
                                </div>
                            </div>
                            <div class="line-2"></div>
                            <div class="payment-detail mt-3">
                                <h5>Tujuan Pembayaran</h5>
                                <p class="subtitle">Metode Pembayaran</p>
                                <div class="bank">
                                    <span>Bank BCA</span>
                                    <div class="row">
                                        <div class="col-6">1751668451</div>
                                        <div class="col-6 text-end">
                                            <a id="copy-bank-account" data-copy="1751668451">
                                                Salin <i class="fa fa-copy"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tagihan mt-2">
                                    <span>Total Tagihan</span>
                                    <div class="row">
                                        <div class="col-6" id="totalTagihan">Rp700,000</div>
                                        <div class="col-6 text-end">
                                            <a id="copy-tagihan" data-copy="700000" id="hargaTotalCopy">
                                                Salin <i class="fa fa-copy"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="f1-buttons">
                            <button type="button" class="btn btn-warning btn-previous  w-100">
                                <i class="fa fa-arrow-left"></i>
                                Sebelumnya
                            </button>
                            <button type="submit" class="btn btn-primary btn-next w-100 mt-2">
                                Proses Pembayaran <i class="fa fa-arrow-right"></i>
                            </button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

        <footer>
            Powered by
            <img src="{{ asset('assets/images/logo/zalamobile.png') }}" alt="Logo zala mobile">
        </footer>
    </div>

@endsection

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        function scroll_to_class(element_class, removed_height) {
            var scroll_to = $(element_class).offset().top - removed_height;
            if ($(window).scrollTop() != scroll_to) {
                $('html, body').stop().animate({
                    scrollTop: scroll_to
                }, 0);
            }
        }

        function bar_progress(progress_line_object, direction) {
            var number_of_steps = progress_line_object.data('number-of-steps');
            var now_value = progress_line_object.data('now-value');
            var new_value = 0;
            if (direction == 'right') {
                new_value = now_value + (100 / number_of_steps);
            } else if (direction == 'left') {
                new_value = now_value - (100 / number_of_steps);
            }
            progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
        }

        $(document).ready(function() {
            // Form
            $('.f1 fieldset:first').fadeIn('slow');

            $('.f1 input[type="text"], .f1 input[type="password"], .f1 textarea').on('focus', function() {
                $(this).removeClass('input-error');
            });

            $('.f1 .btn-next').on('click', function() {
                var parent_fieldset = $(this).parents('fieldset');
                var next_step = true;
                // navigation steps / progress steps
                var current_active_step = $(this).parents('.f1').find('.f1-step.active');
                var progress_line = $(this).parents('.f1').find('.f1-progress-line');

                // validasi form
                parent_fieldset.find('input[type="text"], input[type="password"], textarea, select').not(
                    '[name="laundry_arr[]"], [name="email"]').each(function() {
                    if ($(this).val() == "") {
                        $(this).addClass('input-error');
                        next_step = false;
                    } else {
                        $(this).removeClass('input-error');
                    }
                });


                if (next_step) {
                    parent_fieldset.fadeOut(400, function() {
                        current_active_step.removeClass('active').addClass('activated').next()
                            .addClass('active');
                        bar_progress(progress_line, 'right');
                        // show next step
                        $(this).next().fadeIn();
                        // scroll window to beginning of the form
                        scroll_to_class($('.f1'), 20);
                    });
                }
            });

            $('.f1 .btn-previous').on('click', function() {
                var current_active_step = $(this).parents('.f1').find('.f1-step.active');
                var progress_line = $(this).parents('.f1').find('.f1-progress-line');

                $(this).parents('fieldset').fadeOut(400, function() {
                    current_active_step.removeClass('active').prev().removeClass('activated')
                        .addClass('active');
                    bar_progress(progress_line, 'left');
                    $(this).prev().fadeIn();
                    scroll_to_class($('.f1'), 20);
                });
            });

            $('.f1').on('submit', function(e) {
                $(this).find('input[type="text"], input[type="password"], textarea, select').not(
                    '[name="laundry_arr[]"], [name="email"]').each(
                    function() {
                        if ($(this).val() == "") {
                            e.preventDefault();
                            $(this).addClass('input-error');
                        } else {
                            $(this).removeClass('input-error');
                        }
                    });
            });
        });
    </script>
    <script>
        var ticket = 1;
        var isMember = 'Tidak';
        var isPengurus = false;

        $(document).ready(function() {
            $('#name, #phone_number, #laundry').on('keyup', function() {
                $("#firstName input").val($("#name").val())
                $("#firstPhoneNumber input").val($("#phone_number").val())
                $("#firstLaundry input").val($("#laundry").val())

                $('#tbl_pemesan').text($("#name").val());
            })

            $('.btn-number').click(function(e) {
                e.preventDefault();

                let fieldName = $(this).attr('data-field');
                let type = $(this).attr('data-type');
                let input = $("input[name='" + fieldName + "']");
                let currentVal = parseInt(input.val());

                if (!isNaN(currentVal)) {
                    if (type == 'minus') {
                        if (currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                            $('.repeater-container .repeater-form:last').remove();

                            ticket -= 1;
                            console.log(ticket);
                        }
                        if (parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }
                    } else if (type == 'plus') {
                        if (currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                            addRepeaterForm(currentVal + 1);
                            ticket += 1;
                            console.log(ticket);

                        }
                        if (parseInt(input.val()) == input.attr('max')) {
                            $(this).attr('disabled', true);
                        }
                    }
                } else {
                    input.val(0);
                }
            });

            $('.input-number').focusin(function() {
                $(this).data('oldValue', $(this).val());
            });

            $('.input-number').change(function() {
                let minValue = parseInt($(this).attr('min'));
                let maxValue = parseInt($(this).attr('max'));
                let valueCurrent = parseInt($(this).val());
                let name = $(this).attr('name');

                if (valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled');
                } else {
                    alert('Sorry, the minimum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
                if (valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled');
                } else {
                    alert('Sorry, the maximum value was reached');
                    $(this).val($(this).data('oldValue'));
                }
            });

            $(".input-number").keydown(function(e) {
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    return;
                }
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode >
                        105)) {
                    e.preventDefault();
                }
            });

            function addRepeaterForm(index) {
                let newForm = `
            <div class="row  repeater-form">
                <div class="col-md-12 mt-3">
                    <h5>Peserta ${index}</h5>
                </div>
                <div class="col-md-7 mb-3">
                    <label class="form-label" for="nameArr[]"> Nama <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" id="nameArr[]" name="nameArr[]" placeholder="Adi Sucipto">
                </div>
                <div class="col-md-5 mb-3">
                    <label class="form-label" for="phone_number_arr[]"> Nomor telepon <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" id="phone_number_arr[]" name="phone_number_arr[]" placeholder="0812345678">
                </div>
                <div class="col-md-5 mb-3">
                    <label class="form-label" for="laundry_arr[]"> Nama laundry (Jika ada)</label>
                    <input type="text" class="form-control" id="laundry_arr[]" name="laundry_arr[]" placeholder="Adi laundry">
                </div>
                <div class="col-md-7 mb-3">
                    <label class="form-label" for="certificate[]"> Silahkan isi nama pada sertifikat <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" id="certificate[]" name="certificate[]" placeholder="Adi laundry keren">
                </div>
            </div>`;

                $('.repeater-container').append(newForm);
            }

            $('#copy-bank-account, #copy-tagihan').on('click', function(e) {
                e.preventDefault();
                var copyText = $(this).attr('data-copy');

                // Try to use the modern Clipboard API
                if (navigator.clipboard) {
                    navigator.clipboard.writeText(copyText).then(() => {
                        $(this).html('Tersalin <i class="fa fa-check"></i>');
                        setTimeout(() => {
                            $(this).html('Salin <i class="fa fa-copy"></i>');
                        }, 2000);
                    }).catch(err => {
                        console.error('Failed to copy text: ', err);
                    });
                } else {
                    // Fallback for browsers that do not support the Clipboard API
                    var tempInput = $('<input>');
                    $('body').append(tempInput);
                    tempInput.val(copyText).select();
                    try {
                        document.execCommand('copy');
                        $(this).html('Tersalin <i class="fa fa-check"></i>');
                        setTimeout(() => {
                            $(this).html('Salin <i class="fa fa-copy"></i>');
                        }, 2000);
                    } catch (err) {
                        console.error('Fallback: Oops, unable to copy', err);
                    }
                    tempInput.remove();
                }
            });
        });

        $('#phone_number').on('keyup', function() {
            var phoneNumber = $(this).val();

            if (phoneNumber.length > 11) {
                $.ajax({
                    url: '/member/' + phoneNumber,
                    type: 'GET',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.exists) {
                            $('#member-container').empty();

                            if (response.member.type === 'pengurus') {
                                isPengurus = true;
                            }


                            isMember = 'Ya'
                            $('#tbl_isMember').text(isMember);
                        } else {
                            if ($('#member-container').find('select').length === 0) {
                                $('#member-container').append(`
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" for="member">Apakah anda tertarik untuk bergabung dengan ASLI?
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select" id="member" name="member" required>
                                            <option value="">Pilih disini</option>
                                            <option value="ya">Ya</option>
                                            <option value="tidak">Tidak</option>
                                        </select>
                                    </div>
                                `);
                            }

                            isMember = 'Tidak'
                            $('#tbl_isMember').text(isMember);
                        }
                    },
                    error: function() {
                        console.log('tidak ada');
                    }
                });
            }
        });

        $(document).on('keyup', 'input[name="phone_number_arr[]"]', function() {
            var phoneNumber = $(this).val();
            var inputField = $(this);

            if (phoneNumber.length > 10) {
                $.ajax({
                    url: '/member/' + phoneNumber,
                    type: 'GET',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.exists) {

                            Swal.fire({
                                title: "Member berlebihan terdeteksi",
                                text: "Maksimal hanya 1 member dalam registrasi",
                                icon: "error"
                            });

                            inputField.addClass('input-error');
                        } else {
                            inputField.removeClass('input-error');
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat memeriksa nomor telepon.');
                    }
                });
            }
        });

        function formatRupiah(amount) {
            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            });

            // Format the amount and return it
            return formatter.format(amount);
        }


        $('#checkTotal').on('click', function() {
            $('#tbl_tickets').text(ticket);

            var hargaDasar = ((isMember === 'Ya') ? 200000 : 250000)
            var diskon = isPengurus ? 30 : ((ticket === 2) ? 20 : ((ticket === 3) ? 25 : (ticket > 3 ? 30 : 0)))

            var subtotal = hargaDasar * ticket;
            var totalDiskon = (subtotal * diskon) / 100;
            var totalHarga = subtotal - totalDiskon;


            $('#tbl_total').text(formatRupiah(hargaDasar));
            $('#diskon').text("Diskon (" + diskon + "%)");
            $('#totalDiskon').text(formatRupiah(totalDiskon));

            $('#subtotal').text(formatRupiah(subtotal));
            $('#hargaTotal').text(formatRupiah(totalHarga));
            $('#totalTagihan').text(formatRupiah(totalHarga));
            $('#copy-tagihan').attr('data-copy', totalHarga);
        })
    </script>
@endpush
