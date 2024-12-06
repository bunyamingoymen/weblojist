@extends('index.layouts.main')
@section('index_body')
    @php
        $type = is_null($type) ? 'blog' : $type;
        if ($type == 'Blog') {
            if ($page->type == 1) {
                $title = 'Blog';
            } elseif ($page->type == 2) {
                $title = 'Page';
            } else {
                $title = 'Supplier';
            }
        } else {
            $title = 'Products';
        }
    @endphp
    <!--== Page Title Start ==-->
    <div class="transition-none">
        <section class="title-hero-bg parallax-effect"
            style="background-image: url({{ asset('defaultFiles/title/title_1.jpg') }});">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-title text-center white-color">
                            <h1 class="raleway-font font-300">{{ lang_db($page->title, -1) }}</h1>
                            <div class="breadcrumb mt-20">
                                <!-- Breadcrumb Start -->
                                <ul>
                                    <li><a href="{{ route('index.index') }}">{{ lang_db('Home', 1) }}</a></li>
                                    <li>{{ lang_db($page->title, -1) }}</li>
                                </ul>
                                <!-- Breadcrumb End -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <!--== Page Title End ==-->

    <!--== Blog Details Start ==-->
    <section class="white-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 xs-mb-50">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 mb-50">
                            <div class="post">
                                @if ($type === 'blog' && file_exists($page->image))
                                    <div class="blog-grid-slider slick">
                                        @if (isset($files) && $files->isNotEmpty())
                                            <div class="item">
                                                <img class="img-responsive" src="{{ asset($page->image) }}"
                                                    alt="" />
                                            </div>
                                            @foreach ($files as $file)
                                                <div class="item">
                                                    <img class="img-responsive" src="{{ asset($file->file) }}"
                                                        alt="" />
                                                </div>
                                            @endforeach
                                        @else
                                            @for ($i = 0; $i < 2; $i++)
                                                <div class="item"><img class="img-responsive"
                                                        src="{{ asset($page->image) }}" alt="" /></div>
                                            @endfor
                                        @endif

                                    </div>
                                @elseif (isset($files) && $files->isNotEmpty())
                                    <div class="blog-grid-slider slick">
                                        @if ($files->count() < 2)
                                            @foreach ($files as $file)
                                                @for ($i = 0; $i < 2; $i++)
                                                    <div class="item"><img class="img-responsive"
                                                            src="{{ asset($file->file) }}" alt="" /></div>
                                                @endfor
                                            @endforeach
                                        @else
                                            @foreach ($files as $file)
                                                <div class="item"><img class="img-responsive"
                                                        src="{{ asset($file->file) }}" alt="" /></div>
                                            @endforeach
                                        @endif
                                    </div>
                                @endif

                                <div class="post-info all-padding-40 bordered">
                                    @if (isset($show_title_on_its_own) || isset($show_date_on_its_own))
                                        @if (isset($show_title_on_its_own) && $show_title_on_its_own->optional_1 == '1')
                                            <h3 class="font-20px text-uppercase">
                                                {{ $page->title ? lang_db($page->title, -1) : '' }}
                                            </h3>
                                        @endif
                                        @if (isset($show_date_on_its_own) && $show_date_on_its_own->optional_1 == '1')
                                            <h6>{{ $page->created_at ? $page->created_at->format('F d, Y') : '' }}</h6>
                                        @endif

                                        <hr>
                                    @endif

                                    <p class="font-16px">{!! $page->description ? lang_db($page->description, -1) : '' !!}</p>
                                </div>
                            </div>
                        </div>
                        <!--== Post End ==-->
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!--== Blog Details End ==-->
@endsection
