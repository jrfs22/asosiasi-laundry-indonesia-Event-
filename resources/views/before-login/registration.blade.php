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

        <div class="card wizard-form">
            <div class="card-body wizard-content">
                <h4 class="card-title">Registrasi workshop</h4>
                <form action="#" class="validation-wizard wizard-circle">
                    <!-- Step 1 -->
                    <h6>Data Diri</h6>
                    <section>
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
                            <div class="col-md-12 mb-3">
                                <x-forms.select name="member" label="Apakah anda tertarik untuk bergabung dengan ASLI?">
                                    <option value="ya">Ya</option>
                                    <option value="tidak">Tidak</option>
                                </x-forms.select>
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
                    </section>
                    <!-- Step 2 -->
                    <h6>Peserta</h6>
                    <section>
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
                                        min="1" max="10" disabled>
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
                                        <div class="col-md-7 mb-3">
                                            <x-forms.input2 name="name[]" label="Nama" placeholder="Adi Sucipto"
                                                disabled=1 />
                                        </div>
                                        <div class="col-md-5 mb-3">
                                            <x-forms.input2 name="phone_number[]" label="Nomor telepon"
                                                placeholder="0812345678" disabled=1 />
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <x-forms.input2 name="sertificate[]" label="Nama pada sertifikat"
                                                placeholder="Adi laundry keren" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Step 3 -->
                    <h6>Pembayaran</h6>
                    <section>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="wint1">Interview For :</label>
                                    <input type="text" class="form-control required" id="wint1" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="wintType1">Interview Type :</label>
                                    <select class="form-select required" id="wintType1"
                                        data-placeholder="Type to search cities" name="wintType1">
                                        <option value="Banquet">Normal</option>
                                        <option value="Fund Raiser">Difficult</option>
                                        <option value="Dinner Party">Hard</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="wLocation1">Location :</label>
                                    <select class="form-select required" id="wLocation1" name="wlocation">
                                        <option value="">Select City</option>
                                        <option value="India">India</option>
                                        <option value="USA">USA</option>
                                        <option value="Dubai">Dubai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="wjobTitle2">Interview Date :</label>
                                    <input type="date" class="form-control required" id="wjobTitle2" />
                                </div>
                                <div class="mb-3">
                                    <label for="customRadio16" class="form-label">Requirements :</label>
                                    <div class="c-inputs-stacked">
                                        <div class="form-check">
                                            <input type="radio" id="customRadio16" name="customRadio"
                                                class="form-check-input" />
                                            <label class="form-check-label" for="customRadio16">Employee</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" id="customRadio17" name="customRadio"
                                                class="form-check-input" />
                                            <label class="form-check-label" for="customRadio17">Contract</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
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
    <script src="{{ asset('assets/js/jquery-steps.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-validation.js') }}"></script>
    <script src="{{ asset('assets/js/form-wizard.js') }}"></script>
    <script>
        $(document).ready(function() {
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
                            // Remove the last repeater form section
                            $('.repeater-container .repeater-form:last').remove();
                        }
                        if (parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }
                    } else if (type == 'plus') {
                        if (currentVal < input.attr('max')) {
                            input.val(currentVal + 1).change();
                            addRepeaterForm(currentVal + 1);
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
                    <label class="form-label" for="name[]"> Nama <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" id="name[]" name="name[]" placeholder="Adi Sucipto">
                </div>
                <div class="col-md-5 mb-3">
                    <label class="form-label" for="phone_number[]"> Nomor telepon <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" id="phone_number[]" name="phone_number[]" placeholder="0812345678">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label" for="sertificate[]"> Nama pada sertifikat <span class="text-danger">*</span></label>
                    <input type="text" class="form-control required" id="sertificate[]" name="sertificate[]" placeholder="Adi laundry keren">
                </div>
            </div>`;

                $('.repeater-container').append(newForm);
            }
        });
    </script>
@endpush
