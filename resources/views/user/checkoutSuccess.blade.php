@extends('user.layouts.main')
@section('user_index_body')
    <style>
        .success-animation {
            animation: scale-up 0.5s ease-in-out;
        }

        .success-checkmark {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            background-color: #47bd9a;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .success-checkmark i {
            color: white;
            font-size: 40px;
        }

        .order-track {
            position: relative;
            margin-top: 3rem;
        }

        .track-step {
            position: relative;
            padding-left: 45px;
            margin-bottom: 30px;
        }

        .track-step:before {
            content: '';
            position: absolute;
            left: 9px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e9ecef;
        }

        .track-step:last-child:before {
            display: none;
        }

        .track-step .step-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #47bd9a;
            position: absolute;
            left: 0;
            top: 0;
        }

        .track-step.pending .step-icon {
            background: #e9ecef;
        }

        .track-step .step-text {
            color: #495057;
            font-weight: 500;
        }

        .track-step .step-date {
            color: #74788d;
            font-size: 0.875rem;
        }

        @keyframes scale-up {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .order-details {
            background-color: #f8f9fa;
            border-radius: 4px;
            padding: 1.5rem;
        }

        .product-item {
            display: flex;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 1rem;
        }

        .delivery-address {
            background-color: #fff;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            padding: 1rem;
            margin-top: 1rem;
        }

        .btn-track-order {
            margin-top: 2rem;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="text-center mb-5">
                <div class="success-checkmark success-animation">
                    <i class="mdi mdi-check"></i>
                </div>
                <h2 class="mb-3">{{ lang_db('Your Order Has Been Completed Successfully', 2) }}!</h2>
                <p class="text-muted mb-4">{{ lang_db('Your order number', 2) }}:
                    <strong>#{{ $order_code ?? 'Not Exist' }}</strong>
                </p>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="order-track">
                        <div class="track-step">
                            <div class="step-icon"></div>
                            <div class="step-text">{{ lang_db('Order Received') }}</div>
                            <div class="step-date">{{ $formattedDate }}</div>
                        </div>
                        <div class="track-step pending">
                            <div class="step-icon"></div>
                            <div class="step-text">{{ lang_db('Getting ready') }}</div>
                            <div class="step-date">{{ lang_db('On hold') }}</div>
                        </div>
                        <div class="track-step pending">
                            <div class="step-icon"></div>
                            <div class="step-text">{{ lang_db('Shipped') }}</div>
                            <div class="step-date">{{ lang_db('On hold') }}</div>
                        </div>
                        <div class="track-step pending">
                            <div class="step-icon"></div>
                            <div class="step-text">{{ lang_db('Delivered') }}</div>
                            <div class="step-date">{{ lang_db('On hold') }}</div>
                        </div>
                    </div>

                    <div class="text-center btn-track-order">
                        <a href="{{ route('user.order') }}" class="btn btn-primary mr-2">
                            <i class="mdi mdi-package-variant mr-1"></i> {{ lang_db('View My Orders', 2) }}
                        </a>
                        <a href="{{ route('user.user') }}" class="btn btn-light">
                            <i class="mdi mdi-home mr-1"></i> {{ lang_db('Return to Home Page', 2) }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ route('assetFile', ['folder' => 'admin/libs/jquery', 'filename' => 'jquery.min.js']) }}"></script>

    <script>
        $(document).ready(function() {

            setTimeout(function() {
                $('.success-checkmark').addClass('success-animation');
            }, 100);

            function updateOrderStatus(step) {
                $('.track-step').each(function(index) {
                    if (index <= step) {
                        $(this).removeClass('pending');
                    } else {
                        $(this).addClass('pending');
                    }
                });
            }
            
            updateOrderStatus(1);
        });
    </script>
@endsection
