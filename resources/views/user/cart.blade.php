@extends('user.layouts.main')
@section('user_index_body')
    @php
        $priceTypes = getPriceAllTypes();
        $price_without_vat = [];
        $vat = [];
        $total_price = [];
        $cargo_price = [];
        $all_price = [];
        foreach ($priceTypes as $priceType) {
            $price_without_vat[$priceType->value] = 0;
            $vat[$priceType->value] = 0;
            $total_price[$priceType->value] = 0;
            $cargo_price[$priceType->value] = 0;
            $all_price[$priceType->value] = 0;
        }

    @endphp
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered mb-0 table-nowrap">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="selectAll"
                                                onclick="toggleAll()">
                                            <label class="custom-control-label" for="selectAll">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th></th>
                                    <th>{{ lang_db('Product Name', 2) }}</th>
                                    <th>{{ lang_db('Price', 2) }}</th>
                                    <th>{{ lang_db('Piece(s)', 2) }}</th>
                                    <th>{{ lang_db('Total', 2) }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                    @if ($cart->stock > 0 && $cart->stock >= $cart->product_count)
                                        @php
                                            $priceSymbol = getPriceTypeSymbol($cart->priceType);

                                            $stock = (int) $cart->product_count;

                                            echo $stock;

                                            $price_without_vat[$cart->priceType] +=
                                                (int) $cart->price_without_vat * $stock;

                                            $vat[$cart->priceType] +=
                                                ((int) $cart->price - (int) $cart->price_without_vat) * $stock;

                                            $total_price[$cart->priceType] += (int) $cart->price * $stock;

                                            $cargo_price[$cart->priceType] += (int) $cart->cargo_price * $stock;

                                            $all_price[$cart->priceType] +=
                                                $cargo_price[$cart->priceType] + $total_price[$cart->priceType];
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input product-checkbox"
                                                        id="product1">
                                                    <label class="custom-control-label" for="product1">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td>
                                                <img src="{{ $cart->image ? asset($cart->image) : '' }}" alt="product-img"
                                                    class="cart-product-img" style="max-height: 100px;"
                                                    style="max-width: 100px;">
                                            </td>
                                            <td>{{ $cart->title ?? '' }}</td>
                                            <td>{{ $priceSymbol }} {{ $cart->price ?? '' }}</td>
                                            <td>
                                                <div class="input-group" style="width: 120px;">
                                                    <div class="input-group-prepend">
                                                        <a class="btn btn-primary"
                                                            href= '{{ route('user.addCart') }}?product_code={{ $cart->product_code }}&minus=1'>-</a>
                                                    </div>
                                                    <input type="text" class="form-control text-center"
                                                        value="{{ $cart->product_count > $cart->product_count ? $cart->product_count : $cart->product_count }}">
                                                    <div class="input-group-append">
                                                        <a class="btn btn-primary"
                                                            href= '{{ route('user.addCart') }}?product_code={{ $cart->product_code }}'>+</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $priceSymbol }} {{ $cart->price ? (int) $cart->price * $stock : '' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('user.addCart') }}?product_code={{ $cart->product_code }}&remove_all=1"
                                                    class="text-danger"><i class="mdi mdi-trash-can font-size-18"></i></a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{ lang_db('Order Summary', 2) }}</h4>

                    <div class="table-responsive">
                        <table class="table mb-0">
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
                    <div class="text-center mt-4">
                        <a href="{{ route('user.checkout') }}" class="btn btn-primary">
                            {{ lang_db('Complete Order', 2) }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleAll() {
            const mainCheckbox = document.getElementById('selectAll');
            const productCheckboxes = document.getElementsByClassName('product-checkbox');

            Array.from(productCheckboxes).forEach(checkbox => {
                checkbox.checked = mainCheckbox.checked;
            });
        }
    </script>
@endsection
