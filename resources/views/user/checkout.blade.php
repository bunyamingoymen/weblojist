@extends('user.layouts.main')
@section('user_index_body')
    <style>
        .payment-method-card {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-method-card:hover {
            border-color: #556ee6;
        }

        .payment-method-card.selected {
            border-color: #556ee6;
            background-color: rgba(85, 110, 230, 0.1);
        }

        .address-card {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .address-card:hover {
            border-color: #556ee6;
        }

        .address-card.selected {
            border-color: #556ee6;
            background-color: rgba(85, 110, 230, 0.1);
        }

        .custom-file-label {
            z-index: 1;
        }

        .custom-file-input {
            z-index: 99999999;
            pointer-events: auto;
            opacity: 1;
        }
    </style>
    <form id="checkOutForm" action="{{ route('user.checkout.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">

            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">{{ lang_db('Delivery Address', 2) }}</h4>
                        <div class="row">
                            @foreach ($addresses as $item => $address)
                                <div class="col-md-6 mb-3">
                                    <div class="card address-card selected">
                                        <div class="card-body">
                                            <div class="custom-control custom-radio mb-2">
                                                <input type="radio" id="address{{ $address->code }}" name="address"
                                                    class="custom-control-input" value="{{ $address->code }}"
                                                    {{ $item == 0 ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="address{{ $address->code }}">
                                                    <h5 class="font-size-14 mb-1">{{ $address->address_name }}</h5>
                                                </label>
                                            </div>
                                            <p class="text-muted mb-0">
                                                {{ $address->address }}<br>
                                                {{ $address->county }} / {{ $address->city }}<br>
                                                {{ $address->post_code }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @if (!$addresses->isNotEmpty())
                                <div class="col-md-12 mb-3">
                                    <div class="card address-card selected">
                                        <div class="card-body " style="text-align:center;">
                                            <h3 style="">{{ lang_db('No address defined', 2) }}</h3>
                                            <a href="{{ route('user.profile') }}"
                                                class="btn btn-info">{{ lang_db('Define Address', 2) }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">{{ lang_db('Payment Method', 2) }}</h4>

                        @foreach ($payment_methods as $item => $method)
                            @if ($method->value = 'Money Order')
                                <div class="card payment-method-card mb-3 {{ $item == 0 ? 'selected' : '' }}">
                                    <div class="card-body">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="bankTransfer" name="paymentMethod"
                                                class="custom-control-input" value="Money Order"
                                                {{ $item == 0 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="bankTransfer">
                                                <i class="mdi mdi-bank-outline mr-2"></i>
                                                {{ lang_db('Money Order', 2) }}
                                            </label>
                                        </div>
                                        <div class="mt-4 {{ $item == 0 ? '' : 'd-none' }}" id="bankTransferForm">
                                            @foreach ($iban_informations as $iban)
                                                <div class="alert alert-info">
                                                    <h5 class="alert-heading">{{ lang_db('Account Information', 2) }}</h5>
                                                    <p class="mb-0">
                                                        {{ lang_db('Bank', 2) }}: {{ $iban->optional_1 }}<br>
                                                        {{ lang_db('Account owner', 2) }}: {{ $iban->optional_2 }}<br>
                                                        {{ lang_db('IBAN', 2) }}: {{ $iban->value }}
                                                    </p>
                                                </div>
                                            @endforeach

                                            <div class="mt-4">
                                                <label>{{ lang_db('Upload Receipt', 2) }}</label>
                                                <div class="col-lg-12 row mt-3">
                                                    <div>
                                                        <input type="file" class="form-control" id="receipt"
                                                            name="receipt">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($method->value = 'Credit Cart')
                                <div class="card payment-method-card mb-3 {{ $item == 0 ? 'selected' : '' }}">
                                    <div class="card-body">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="creditCard" value="Credit Cart" name="paymentMethod"
                                                class="custom-control-input" {{ $item == 0 ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="creditCard">
                                                <i class="mdi mdi-credit-card-outline mr-2"></i>
                                                {{ lang_db('Credit Cart', 2) }}
                                            </label>
                                        </div>
                                        <div class="mt-4" id="creditCardForm">
                                            <div class="form-group">
                                                <label>{{ lang_db('Name', 2) }}</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>{{ lang_db('Cart Number', 2) }}</label>
                                                <input type="text" class="form-control"
                                                    placeholder="**** **** **** ****">
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ lang_db('Expiration date', 2) }}</label>
                                                        <input type="text" class="form-control" placeholder="MM/YY">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ lang_db('CVV', 2) }}</label>
                                                        <input type="text" class="form-control" placeholder="***">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">{{ lang_db('Order Summary', 2) }}</h4>

                        <div class="table-responsive">
                            <table class="table table-centered mb-0">
                                <tbody>

                                    @foreach ($price_without_vat as $type => $price)
                                        @if ($price <= 0)
                                            @continue
                                        @endif
                                        <tr>
                                            <td>{{ lang_db('Price', 2) }} ({{ $type }}) :</td>
                                            <td>{{ getPriceTypeSymbol($type) ?? '' }} {{ $price }}</td>
                                        </tr>
                                    @endforeach

                                    @foreach ($vat as $type => $price)
                                        @if ($price <= 0)
                                            @continue
                                        @endif
                                        <tr>
                                            <td>{{ lang_db('VAT', 2) }} ({{ $type }}) :</td>
                                            <td>{{ getPriceTypeSymbol($type) ?? '' }} {{ $price }}</td>
                                        </tr>
                                    @endforeach

                                    @foreach ($cargo_price as $type => $price)
                                        @if ($price <= 0)
                                            @continue
                                        @endif
                                        <tr>
                                            <td>{{ lang_db('Cargo Price', 2) }} ({{ $type }}) :</td>
                                            <td>{{ getPriceTypeSymbol($type) ?? '' }} {{ $price }}</td>
                                        </tr>
                                    @endforeach

                                    @foreach ($all_price as $type => $price)
                                        @if ($price <= 0)
                                            @continue
                                        @endif
                                        <tr>
                                            <th>{{ lang_db('Total Price', 2) }} ({{ $type }}) :</th>
                                            <th>{{ getPriceTypeSymbol($type) ?? '' }} {{ $price }}</th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            <button type="button" class="btn btn-primary btn-block" onclick="submitOrder()">
                                {{ lang_db('Complete Order', 2) }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <script src="{{ route('assetFile', ['folder' => 'admin/libs/jquery', 'filename' => 'jquery.min.js']) }}"></script>

    <script>
        $(document).ready(function() {
            // Adres seçimi
            $('.address-card').click(function() {
                $('.address-card').removeClass('selected');
                $(this).addClass('selected');
                $(this).find('input[type="radio"]').prop('checked', true);
            });

            // Ödeme yöntemi seçimi
            $('.payment-method-card').click(function() {
                $('.payment-method-card').removeClass('selected');
                $(this).addClass('selected');
                $(this).find('input[type="radio"]').prop('checked', true);

                // Form gösterme/gizleme
                $('#creditCardForm').addClass('d-none');
                $('#bankTransferForm').addClass('d-none');

                if ($(this).find('#creditCard').is(':checked')) {
                    $('#creditCardForm').removeClass('d-none');
                } else if ($(this).find('#bankTransfer').is(':checked')) {
                    $('#bankTransferForm').removeClass('d-none');
                }
            });
        });

        // Sipariş tamamlama
        function submitOrder() {
            const address = document.querySelector('input[name="address"]:checked');
            const radio2 = document.querySelector('input[name="paymentMethod"]:checked');
            const fileInput = document.getElementById('receipt');

            // 1. Radio Buton Kontrolü
            if (!address) {
                Swal.fire({
                    icon: "error",
                    title: "{{ lang_db('Error!', 2) }}",
                    text: "{{ lang_db('Please select an address', 2) }}",
                    background: '#fff'
                });
                return;
            }

            // 2. Radio Buton Kontrolü
            if (!radio2) {
                Swal.fire({
                    icon: "error",
                    title: "{{ lang_db('Error!', 2) }}",
                    text: "{{ lang_db('Please select payment method', 2) }}",
                    background: '#fff'
                });
                return;
            }

            // 2. Radio Buton Spesifik Seçeneği Kontrolü ve Dosya Kontrolü
            if (radio2.value === 'Money Order' && !fileInput.value) {
                Swal.fire({
                    icon: "error",
                    title: "{{ lang_db('Error!', 2) }}",
                    text: "{{ lang_db('Please select the receipt file', 2) }}",
                    background: '#fff'
                });
                return;
            }

            // Başarılı doğrulama
            document.getElementById('checkOutForm').submit();
        }
    </script>
@endsection
