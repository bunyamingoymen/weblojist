@extends('user.layouts.main')
@section('user_index_body')
    <style>
        .img-fluid {
            width: 100%;
            height: 350px;

            object-fit: contain;
            background-color: #f0f0f0;
        }
    </style>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-xl-4 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="product-img">
                            <img src="{{ $product->file ? asset($product->file) : '' }}" class="img-fluid mx-auto d-block"
                                alt="product-img">
                        </div>
                        <div class="mt-4 text-center">
                            <h5 class="mb-3 text-truncate"><a
                                    href="{{ route('user.product', ['productCode' => $product->short_name]) }}"
                                    class="text-dark">{{ $product->title }}</a></h5>
                            <h5 class="my-0"><span class="text-muted mr-2"></span>
                                <b>{{ $product->priceTypeSymbol }} {{ $product->price }}</b>
                            </h5>
                        </div>
                        <div style="text-align-last: justify;">
                            <a class="btn btn-info"
                                href ='{{ route('user.addCart') }}?product_code={{ $product->code }}'>{{ lang_db('Add to cart', 2) }}</a>
                            <a class="btn btn-warning"
                                href = '{{ route('user.product', ['productCode' => $product->short_name]) }}'>{{ lang_db('Detail', 2) }}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <div class="row mt-4">
        <div class="col-sm-12 col-md-12">
            <div class="dataTables_paginate paging_simple_numbers">
                <ul class="pagination pagination-rounded justify-content-center">
                    @if ($products->currentPage() > 1)
                        <li class="paginate_button page-item previous">
                            <a href="{{ $products->previousPageUrl() }}" class="page-link">
                                <i class="mdi mdi-chevron-left"></i>
                            </a>
                        </li>
                    @else
                        <li class="paginate_button page-item previous disabled">
                            <a href="#" class="page-link">
                                <i class="mdi mdi-chevron-left"></i>
                            </a>
                        </li>
                    @endif

                    @if ($products->currentPage() > 3)
                        <li class="paginate_button page-item">
                            <a href="{{ $products->url(1) }}" class="page-link">1</a>
                        </li>
                        @if ($products->currentPage() > 4)
                            <li class="paginate_button page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        @endif
                    @endif

                    @foreach (range(1, $products->lastPage()) as $i)
                        @if ($i >= $products->currentPage() - 2 && $i <= $products->currentPage() + 2)
                            <li class="paginate_button page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                                <a href="{{ $products->url($i) }}" class="page-link">{{ $i }}</a>
                            </li>
                        @endif
                    @endforeach

                    @if ($products->currentPage() < $products->lastPage() - 2)
                        @if ($products->currentPage() < $products->lastPage() - 3)
                            <li class="paginate_button page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                        @endif
                        <li class="paginate_button page-item">
                            <a href="{{ $products->url($products->lastPage()) }}"
                                class="page-link">{{ $products->lastPage() }}</a>
                        </li>
                    @endif

                    @if ($products->currentPage() < $products->lastPage())
                        <li class="paginate_button page-item next">
                            <a href="{{ $products->nextPageUrl() }}" class="page-link">
                                <i class="mdi mdi-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="paginate_button page-item next disabled">
                            <a href="#" class="page-link">
                                <i class="mdi mdi-chevron-right"></i>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

@endsection
