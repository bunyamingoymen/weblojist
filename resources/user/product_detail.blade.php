@extends('user.layouts.main')
@section('user_index_body')
    <style>
        .product-slider img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .slick-prev:before,
        .slick-next:before {
            color: #556ee6;
        }

        .low-stock {
            animation: blink 1s infinite;
            color: #f46a6a;
            font-weight: bold;
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        .product-info-item {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .product-info-label {
            font-weight: 600;
            color: #495057;
        }
    </style>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="product-slider">
                        @foreach ($files as $file)
                            <div>
                                <img src="{{ $file->file ? asset($file->file) : '' }}" alt="product image">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $product->title ?? '' }}</h4>
                    <div class="product-info">
                        <div class="product-info-item">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="product-info-label">{{ lang_db('Category', 2) }}:</span>
                                </div>
                                <div class="col-md-8">
                                    <span>{{ $category->value ?? lang_db('Not Exist') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="product-info-item">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="product-info-label">{{ lang_db('Price', 2) }}:</span>
                                </div>
                                <div class="col-md-8">
                                    <h3 class="text-primary">{{ $product->priceTypeSymbol }} {{ $product->price ?? '0.0' }}
                                    </h3>
                                </div>
                            </div>
                        </div>

                        <div class="product-info-item">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="product-info-label">{{ lang_db('Stock Status', 2) }}:</span>
                                </div>
                                <div class="col-md-8">
                                    <span
                                        class="{{ isset($product->stock) && (int) $product->stock < 3 ? 'low-stock' : '' }}">{{ $product->stock ?? '999' }}
                                        {{ lang_db('Pieces Left', 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="product-info-item">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="product-info-label">{{ lang_db('Cargo Company', 2) }} :</span>
                                </div>
                                <div class="col-md-8">
                                    <span>{{ $cargo_company->value ?? lang_db('Not Exist') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="product-info-item">
                            <div class="row">
                                <div class="col-md-4">
                                    <span class="product-info-label">{{ lang_db('Estimated Delivery', 2) }}:</span>
                                </div>
                                <div class="col-md-8">
                                    <span>{{ $product->time ?? '999' }} {{ lang_db('Workday(s)', 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('user.addCart') }}?product_code={{ $product->code }}"
                            class="btn btn-primary waves-effect waves-light">
                            <i class="mdi mdi-cart mr-1"></i> {{ lang_db('Add to cart', 2) }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ lang_db('Product Description', 2) }}</h4>
                    <p class="card-title-desc">
                        {!! $product->description ?? '' !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ route('assetFile', ['folder' => 'admin/libs/jquery', 'filename' => 'jquery.min.js']) }}"></script>
    <script>
        $(document).ready(function() {
            $('.product-slider').slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000
            });
        });
    </script>
@endsection
