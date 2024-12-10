@extends('index.genz.layouts.main')
@section('index_body')
    <div class="cover-home3">
        <div class="container">
            <div class="row">
                <div class="col-xl-1"></div>
                <div class="col-xl-10 col-lg-12">
                    <div class="pt-30 border-bottom border-gray-800 pb-20">
                        <div class="box-breadcrumbs">
                            <ul class="breadcrumb">
                                <li><a class="home" href="{{ route('index.index') }}">{{ lang_db('Home', 1) }}</a></li>
                                <li><span>{{ lang_db('Blog', 1) }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-50 mb-50">
                        <div class="row mt-50 mb-10">
                            @foreach ($blogs as $blog)
                                @php

                                    if ($blog->created_at) {
                                        $date = \Carbon\Carbon::parse($blog->created_at);
                                        $day = $date->format('d');
                                        $month = lang_db($date->format('F'), 1); // Ayı dil dosyasından çekiyoruz
                                        $year = $date->format('Y');
                                        $result_date = $day . ' ' . $month . ' ' . $year;
                                    } else {
                                        $result_date = '';
                                    }

                                    $url = $blog->short_name ?? 'not-found';
                                @endphp
                                <div class="col-lg-4">
                                    <div class="card-blog-1 hover-up wow animate__animated animate__fadeIn">
                                        <div class="card-image mb-20">
                                            @if ($blog->pinned)
                                                <a class="post-type post-pinned"
                                                    href="{{ route('index.blog.detail', ['pageCode' => $url]) }}"></a>
                                            @endif
                                            <a href="{{ route('index.blog.detail', ['pageCode' => $url]) }}">
                                                <img src="{{ $blog->image ? asset($blog->image) : '' }}" alt="Genz">
                                            </a>
                                        </div>
                                        <div class="card-info">
                                            <a href="{{ route('index.blog.detail', ['pageCode' => $url]) }}">
                                                <h5 class="color-white mt-20">
                                                    {{ $blog->title }}
                                                </h5>
                                            </a>
                                            <div class="row align-items-center mt-25">
                                                <div class="col-7">
                                                    <div class="box-author">
                                                        @if ($blog->admin_image)
                                                            <img src="{{ asset($blog->admin_image) }}"
                                                                alt="{{ $blog->admin_image }}">
                                                        @endif

                                                        <div class="author-info">
                                                            @if ($blog->admin_image)
                                                                <h6 class="color-gray-700">
                                                                    {{ $blog->admin_name }}</h6>
                                                            @endif
                                                            <span class="color-gray-700">{{ $result_date }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-5 text-end"><a class="readmore color-gray-500 text-sm"
                                                        href="{{ route('index.blog.detail', ['pageCode' => $url]) }}"><span>{{ lang_db('Read More', 1) }}</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @php
                            $currentPage = $blogs->currentPage(); // Mevcut sayfa
                            $lastPage = $blogs->lastPage(); // Toplam sayfa sayısı
                            $paginationRange = 5; // Gösterilecek maksimum sayfa sayısı
                        @endphp
                        <nav class="mb-50">
                            <ul class="pagination">
                                <!-- Geri Butonu -->
                                @if ($currentPage > 1)
                                    <li class="page-item wow animate__animated animate__fadeIn" data-wow-delay=".0s">
                                        <a class="page-link page-prev" href="{{ $blogs->url($currentPage - 1) }}">
                                            <i class="fi-rr-arrow-small-left"></i>
                                        </a>
                                    </li>
                                @endif

                                <!-- İlk Sayfa -->
                                @if ($currentPage > floor($paginationRange / 2) + 1)
                                    <li class="page-item wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                        <a class="page-link" href="{{ $blogs->url(1) }}">1</a>
                                    </li>
                                    @if ($currentPage > floor($paginationRange / 2) + 2)
                                        <li class="page-item wow animate__animated animate__fadeIn" data-wow-delay=".2s">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    @endif
                                @endif

                                <!-- Sayfalar -->
                                @for ($page = max(1, $currentPage - floor($paginationRange / 2)); $page <= min($lastPage, $currentPage + floor($paginationRange / 2)); $page++)
                                    <li class="page-item wow animate__animated animate__fadeIn {{ $page == $currentPage ? 'active' : '' }}"
                                        data-wow-delay=".3s">
                                        <a class="page-link" href="{{ $blogs->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endfor

                                <!-- Son Sayfa -->
                                @if ($currentPage < $lastPage - floor($paginationRange / 2))
                                    @if ($currentPage < $lastPage - floor($paginationRange / 2) - 1)
                                        <li class="page-item wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                                            <a class="page-link" href="#">...</a>
                                        </li>
                                    @endif
                                    <li class="page-item wow animate__animated animate__fadeIn" data-wow-delay=".5s">
                                        <a class="page-link" href="{{ $blogs->url($lastPage) }}">{{ $lastPage }}</a>
                                    </li>
                                @endif

                                <!-- İleri Butonu -->
                                @if ($currentPage < $lastPage)
                                    <li class="page-item wow animate__animated animate__fadeIn" data-wow-delay=".6s">
                                        <a class="page-link page-next" href="{{ $blogs->url($currentPage + 1) }}">
                                            <i class="fi-rr-arrow-small-right"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </nav>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
