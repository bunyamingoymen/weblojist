@extends('user.layouts.main')
@section('user_index_body')
    <style>
        .order-product-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: -10px;
            border: 2px solid #fff;
        }

        .order-more-products {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f8f9fa;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            margin-left: 5px;
            border: 2px solid #fff;
        }

        .order-details {
            display: none;
        }

        .order-row {
            cursor: pointer;
        }

        .order-row:hover {
            background-color: #f8f9fa;
        }
    </style>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-centered mb-0">
                            <thead>
                                <tr>
                                    <th>{{ lang_db('Order Number', 2) }}</th>
                                    <th>{{ lang_db('Date', 2) }}</th>
                                    <th>{{ lang_db('Products', 2) }}</th>
                                    <th>{{ lang_db('Total', 2) }}</th>
                                    <th>{{ lang_db('Status', 2) }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($formattedOrders as $order)
                                    <tr class="order-row" onclick="toggleOrderDetails('{{ $order['order_code'] }}')">
                                        <td>#{{ $order['order_code'] }}</td>
                                        <td>{{ $order['order_date'] }}</td>
                                        <td>
                                            <span class="order-more-products">+{{ count($order['products']) }}</span>

                                        </td>
                                        <td>₺ {{ $order['order_price'] }}</td>
                                        <td>
                                            @if ($order['order_status'] == -1)
                                                <span class="badge badge-danger">{{ lang_db('Cancelled', 2) }}</span>
                                            @elseif ($order['order_status'] == 0)
                                                <span
                                                    class="badge badge-warning">{{ lang_db('Awaiting payment', 2) }}</span>
                                            @elseif ($order['order_status'] == 1)
                                                <span
                                                    class="badge badge-secondary">{{ lang_db('Awaiting Approval', 2) }}</span>
                                            @elseif ($order['order_status'] == 2)
                                                <span class="badge badge-info">{{ lang_db('Getting ready', 2) }}</span>
                                            @elseif ($order['order_status'] == 3)
                                                <span class="badge badge-primary">{{ lang_db('Shipped', 2) }}</span>
                                            @elseif ($order['order_status'] == 4)
                                                <span class="badge badge-success">{{ lang_db('Delivered', 2) }}</span>
                                            @endif

                                        </td>
                                        <td>
                                            <i class="mdi mdi-chevron-down"></i>
                                        </td>
                                    </tr>
                                    <tr id="orderDetails{{ $order['order_code'] }}" class="order-details">
                                        <td colspan="7">
                                            <div class="p-3">
                                                <h5>Sipariş Detayları</h5>
                                                <div class="row mt-3">
                                                    <div class="col-md-6">
                                                        <p><strong>{{ lang_db('Delivery Address', 2) }} :</strong><br>
                                                            {{ Auth::user()->name }}<br>
                                                            {{ $order['address_name'] }}<br>
                                                            {{ $order['address'] }}<br>
                                                            {{ $order['county'] }}, {{ $order['city'] }}<br>
                                                            {{ $order['post_code'] }}</p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><strong>{{ lang_db('Products') }}:</strong></p>
                                                        <ul class="list-unstyled">
                                                            @foreach ($order['products'] as $product)
                                                                <li>{{ $product['order_product_count'] }}x
                                                                    {{ $product['product_title'] }} -
                                                                    {{ $product['order_total_product_price'] }}
                                                                    {{ getPriceTypeSymbol($product['order_total_product_price_type']) }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleOrderDetails(orderId) {
            const detailsRow = document.getElementById('orderDetails' + orderId);
            const currentDisplay = detailsRow.style.display;
            detailsRow.style.display = currentDisplay === 'table-row' ? 'none' : 'table-row';
        }
    </script>
@endsection
