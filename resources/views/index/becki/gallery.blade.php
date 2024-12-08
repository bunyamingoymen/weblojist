@extends('index.layouts.main')
@section('index_body')
    @php
        $gallery_title = getCachedKeyValue(['key' => 'gallery_title', 'first' => true, 'refreshCache' => true]) ?? null;
        $gallery_description =
            getCachedKeyValue(['key' => 'gallery_description', 'first' => true, 'refreshCache' => true]) ?? null;

        $show_page_titles =
            getCachedKeyValue(['key' => 'show_page_titles', 'first' => true, 'refreshCache' => true]) ?? null;
    @endphp
    <style>
        /* Car Gallery Styles */
        .car-brand-filter {
            margin-bottom: 40px;
        }

        .btn-filter {
            background: transparent;
            border: 2px solid #eee;
            padding: 8px 20px;
            margin: 0 5px;
            border-radius: 30px;
            color: #333;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-filter:hover,
        .btn-filter.active {
            background: #4facfe;
            border-color: #4facfe;
            color: #fff;
        }

        .car-box {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            transition: all 0.3s ease;
            opacity: 1;
            /* Eklendi */
        }

        .car-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .car-img {
            position: relative;
            overflow: hidden;
        }

        .car-img img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: all 0.5s ease;
        }

        .car-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.3s ease;
        }

        .car-box:hover .car-overlay {
            opacity: 1;
        }

        .car-overlay-buttons {
            text-align: center;
        }

        .car-overlay-buttons .btn {
            margin: 5px;
            padding: 8px 20px;
            font-size: 13px;
        }

        .car-details {
            padding: 20px;
            text-align: center;
        }

        .car-details h4 {
            margin: 0 0 15px;
            font-size: 18px;
            font-weight: 600;
            text-align: center;
        }

        .car-specs {
            margin-bottom: 15px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .car-specs span {
            font-size: 13px;
            color: #666;
        }

        .car-specs i {
            margin-right: 5px;
            color: #4facfe;
        }

        .car-price {
            text-align: center;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }

        .car-price .price {
            font-size: 20px;
            font-weight: 600;
            color: #4facfe;
        }

        /* Responsive styles */
        @media (max-width: 767px) {
            .car-brand-filter .btn-filter {
                margin: 5px;
                padding: 6px 15px;
                font-size: 12px;
            }

            .car-specs {
                flex-direction: column;
            }

            .car-specs span {
                margin-bottom: 5px;
            }
        }

        .white-bg {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* En az ekranın %100 yüksekliğini kaplar */
            background-color: #f8f8f8;
            /* Arka plan rengi isteğe bağlı */
        }
    </style>

    @if (isset($show_page_titles) && $show_page_titles->value == '1')
        <div class="transition-none">
            <section class="title-hero-bg parallax-effect"
                style="background-image: url({{ asset('defaultFiles/title/title_1.jpg') }});">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-title text-center white-color">
                                <h1 class="raleway-font font-300">{{ lang_db($title, 1) }}</h1>
                                <div class="breadcrumb mt-20">
                                    <ul>
                                        <li><a href="{{ route('index.index') }}">{{ lang_db('Home', 1) }}</a></li>
                                        <li>{{ lang_db($title, 1) }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    @endif


    <section class="car-gallery white-bg" id="cars">
        <div class="container">
            <div class="row">
                <div class="col-md-8 centerize-col text-center">
                    <div class="section-title">
                        <h2 class="raleway-font">{{ isset($gallery_title) ? lang_db($gallery_title->value) : '' }}</h2>
                        <p>{{ isset($gallery_description) ? lang_db($gallery_description->value) : '' }}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="car-brand-filter text-center mb-50">
                        <button class="btn btn-filter active" data-brand="all">{{ lang_db('All', 1) }}</button>
                        @foreach ($categories as $category)
                            <button class="btn btn-filter"
                                data-brand="{{ $category->code }}">{{ lang_db($category->value, -1) }}</button>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row car-grid">
                @foreach ($galleries as $gallery)
                    @php
                        $url = $gallery->short_name ?? 'not-found';
                    @endphp
                    <div class="col-md-4 col-sm-6 car-item" data-brand="{{ $gallery->category }}">
                        <div class="car-box">
                            <div class="car-img">
                                <img src="{{ $gallery->image ? asset($gallery->image) : '' }}"
                                    alt="{{ $gallery->title }}">
                                <div class="car-overlay">
                                    <div class="car-overlay-buttons">
                                        <a href="{{ route('index.blog.detail', ['pageCode' => $url]) }}"
                                            {{ $gallery->open_different_page ? 'target="_blank"' : '' }}
                                            class="btn btn-light-outline btn-sm">{{ lang_db('Details', 1) }}</a>
                                    </div>
                                </div>
                            </div>
                            <div class="car-details">
                                <h4>
                                    <a {{ $gallery->open_different_page ? 'target="_blank"' : '' }}
                                        href="{{ route('index.blog.detail', ['pageCode' => $url]) }}">{{ $gallery->title }}</a>

                                </h4>
                                <div class="car-price">
                                    <span class="price">
                                        <a {{ $gallery->open_different_page ? 'target="_blank"' : '' }}
                                            href="{{ route('index.blog.detail', ['pageCode' => $url]) }}">{{ $gallery->sub_title }}</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <script>
        const filterButtons = document.querySelectorAll('.btn-filter');
        const carItems = document.querySelectorAll('.car-item');

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                filterButtons.forEach(btn => btn.classList.remove('active'));

                button.classList.add('active');

                const selectedBrand = button.getAttribute('data-brand');


                carItems.forEach(item => {

                    item.style.opacity = '0';
                    item.style.transition = 'opacity 0.3s ease';

                    setTimeout(() => {

                        if (selectedBrand === 'all' || item.getAttribute('data-brand') ===
                            selectedBrand) {
                            item.style.display = 'block';

                            setTimeout(() => {
                                item.style.opacity = '1';
                            }, 50);
                        } else {
                            item.style.display = 'none';
                        }
                    }, 300);
                });
            });
        });

        window.addEventListener('load', () => {
            carItems.forEach(item => {
                item.style.opacity = '1';
                item.style.transition = 'opacity 0.3s ease';
            });
        });
    </script>
@endsection
