@extends('index.genz.layouts.main')
@section('index_body')
    <div class="cover-home3">
        <div class="container">
            <div class="row">
                <div class="col-xl-1"></div>
                <div class="col-xl-10 col-lg-12">
                    @if (isset($backgroudSettings) &&
                            $backgroudSettings->value == 'slider' &&
                            isset($backgrouds) &&
                            $backgrouds->isNotEmpty())
                        <div class="row mt-90 mb-50">
                            <div class="col-lg-12">
                                <div class="box-list-posts">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="card-blog-1 card-blog-2 hover-up wow animate__animated animate__fadeIn"
                                                data-wow-delay="0">
                                                <div class="card-image mb-20"><a
                                                        href="{{ $backgrouds[0]->optional_3 ? url($backgrouds[0]->optional_3) : '#' }}"><img
                                                            src="{{ $backgrouds[0]->optional_5 ? asset($backgrouds[0]->optional_5) : '' }}"
                                                            alt="{{ $backgrouds[0]->optional_6 ?? '' }}"></a>
                                                </div>
                                                <div class="card-info"><a
                                                        href="{{ $backgrouds[0]->optional_3 ? url($backgrouds[0]->optional_3) : '#' }}">
                                                        <h4 class="color-white mt-30">
                                                            {{ $backgrouds[0]->optional_6 ?? '' }}
                                                        </h4>
                                                    </a>
                                                    <p class="mt-25 text-lg color-gray-700">
                                                        {{ $backgrouds[0]->optional_7 ?? '' }}
                                                    </p>
                                                    <div class="row align-items-center mt-45">
                                                        <div class="col-7">
                                                            <div class="box-author">
                                                                <div class="author-info">
                                                                    <span class="color-gray-700 text-sm">
                                                                        @php
                                                                            if ($backgrouds[0]->optional_8) {
                                                                                $date = \Carbon\Carbon::parse(
                                                                                    $backgrouds[0]->optional_8,
                                                                                );
                                                                                $day = $date->format('d');
                                                                                $month = lang_db($date->format('F'), 1); // Ayı dil dosyasından çekiyoruz
                                                                                $year = $date->format('Y');
                                                                                $result_date =
                                                                                    $day . ' ' . $month . ' ' . $year;
                                                                            } else {
                                                                                $result_date = '';
                                                                            }
                                                                        @endphp
                                                                        {{ $result_date }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-5 text-end"><a
                                                                class="readmore color-gray-500 text-sm"
                                                                href="{{ $backgrouds[0]->optional_3 ? url($backgrouds[0]->optional_3) : '#' }}"><span>{{ lang_db('Read More', 1) }}</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="row">
                                                @foreach ($backgrouds as $backgroud)
                                                    @if ($loop->index == 0)
                                                        @continue;
                                                    @endif
                                                    <div class="col-lg-12">
                                                        <div class="card-list-posts card-list-posts-small mb-30 wow animate__animated animate__fadeIn"
                                                            data-wow-delay="0.1s">
                                                            <div class="card-image hover-up">
                                                                <a
                                                                    href="{{ $backgroud->optional_3 ? url($backgroud->optional_3) : '#' }}">
                                                                    <img src="{{ $backgroud->optional_5 ? asset($backgroud->optional_5) : '' }}"
                                                                        alt="{{ $backgroud->optional_6 ?? '' }}">
                                                                </a>
                                                            </div>
                                                            <div class="card-info">
                                                                <a
                                                                    href="{{ $backgroud->optional_3 ? url($backgroud->optional_3) : '#' }}">
                                                                    <h5 class="mb-10 color-white">
                                                                        {{ $backgroud->optional_6 ?? '' }}
                                                                    </h5>
                                                                </a>
                                                                <div class="row mt-10">
                                                                    <div class="col-12">
                                                                        <span
                                                                            class="calendar-icon color-gray-700 text-sm mr-20">
                                                                            @php
                                                                                if ($backgroud->optional_8) {
                                                                                    $date = \Carbon\Carbon::parse(
                                                                                        $backgroud->optional_8,
                                                                                    );
                                                                                    $day = $date->format('d');
                                                                                    $month = lang_db(
                                                                                        $date->format('F'),
                                                                                        1,
                                                                                    ); // Ayı dil dosyasından çekiyoruz
                                                                                    $year = $date->format('Y');
                                                                                    $result_date =
                                                                                        $day .
                                                                                        ' ' .
                                                                                        $month .
                                                                                        ' ' .
                                                                                        $year;
                                                                                } else {
                                                                                    $result_date = '';
                                                                                }
                                                                            @endphp
                                                                            {{ $result_date }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row mt-70">
                        <div class="col-lg-4 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="card-blog-1 hover-up">
                                <div class="card-image mb-20"><a class="post-type" href="blog-archive.html"></a><a
                                        href="single-sidebar.html"><img src="assets/imgs/page/homepage1/news3.png"
                                            alt="Genz"></a></div>
                                <div class="card-info">
                                    <div class="row">
                                        <div class="col-7"><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Design</a><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Movie</a>
                                        </div>
                                        <div class="col-5 text-end"><span class="color-gray-700 text-sm timeread">6 mins
                                                read</span></div>
                                    </div><a href="single-sidebar.html">
                                        <h5 class="color-white mt-20"> Self-observation is the first step of inner
                                            unfolding</h5>
                                    </a>
                                    <div class="row align-items-center mt-25">
                                        <div class="col-7">
                                            <div class="box-author"><img src="assets/imgs/page/homepage1/author3.png"
                                                    alt="Genz">
                                                <div class="author-info">
                                                    <h6 class="color-gray-700">Joseph</h6><span
                                                        class="color-gray-700 text-sm">27 Sep 2022</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 text-end"><a class="readmore color-gray-500 text-sm"
                                                href="single-sidebar.html"><span>Read more</span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="card-blog-1 hover-up">
                                <div class="card-image mb-20"><a class="post-type" href="blog-archive.html"></a><a
                                        href="single-sidebar.html"><img src="assets/imgs/page/homepage1/news3.png"
                                            alt="Genz"></a></div>
                                <div class="card-info">
                                    <div class="row">
                                        <div class="col-7"><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Design</a><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Movie</a>
                                        </div>
                                        <div class="col-5 text-end"><span class="color-gray-700 text-sm timeread">6 mins
                                                read</span></div>
                                    </div><a href="single-sidebar.html">
                                        <h5 class="color-white mt-20"> Self-observation is the first step of inner
                                            unfolding</h5>
                                    </a>
                                    <div class="row align-items-center mt-25">
                                        <div class="col-7">
                                            <div class="box-author"><img src="assets/imgs/page/homepage1/author3.png"
                                                    alt="Genz">
                                                <div class="author-info">
                                                    <h6 class="color-gray-700">Joseph</h6><span
                                                        class="color-gray-700 text-sm">27 Sep 2022</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 text-end"><a class="readmore color-gray-500 text-sm"
                                                href="single-sidebar.html"><span>Read more</span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="card-blog-1 hover-up">
                                <div class="card-image mb-20"><a class="post-type" href="blog-archive.html"></a><a
                                        href="single-sidebar.html"><img src="assets/imgs/page/homepage1/news3.png"
                                            alt="Genz"></a></div>
                                <div class="card-info">
                                    <div class="row">
                                        <div class="col-7"><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Design</a><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Movie</a>
                                        </div>
                                        <div class="col-5 text-end"><span class="color-gray-700 text-sm timeread">6 mins
                                                read</span></div>
                                    </div><a href="single-sidebar.html">
                                        <h5 class="color-white mt-20"> Self-observation is the first step of inner
                                            unfolding</h5>
                                    </a>
                                    <div class="row align-items-center mt-25">
                                        <div class="col-7">
                                            <div class="box-author"><img src="assets/imgs/page/homepage1/author3.png"
                                                    alt="Genz">
                                                <div class="author-info">
                                                    <h6 class="color-gray-700">Joseph</h6><span
                                                        class="color-gray-700 text-sm">27 Sep 2022</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 text-end"><a class="readmore color-gray-500 text-sm"
                                                href="single-sidebar.html"><span>Read more</span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="card-blog-1 hover-up">
                                <div class="card-image mb-20"><a class="post-type" href="blog-archive.html"></a><a
                                        href="single-sidebar.html"><img src="assets/imgs/page/homepage1/news3.png"
                                            alt="Genz"></a></div>
                                <div class="card-info">
                                    <div class="row">
                                        <div class="col-7"><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Design</a><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Movie</a>
                                        </div>
                                        <div class="col-5 text-end"><span class="color-gray-700 text-sm timeread">6 mins
                                                read</span></div>
                                    </div><a href="single-sidebar.html">
                                        <h5 class="color-white mt-20"> Self-observation is the first step of inner
                                            unfolding</h5>
                                    </a>
                                    <div class="row align-items-center mt-25">
                                        <div class="col-7">
                                            <div class="box-author"><img src="assets/imgs/page/homepage1/author3.png"
                                                    alt="Genz">
                                                <div class="author-info">
                                                    <h6 class="color-gray-700">Joseph</h6><span
                                                        class="color-gray-700 text-sm">27 Sep 2022</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 text-end"><a class="readmore color-gray-500 text-sm"
                                                href="single-sidebar.html"><span>Read more</span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="card-blog-1 hover-up">
                                <div class="card-image mb-20"><a class="post-type" href="blog-archive.html"></a><a
                                        href="single-sidebar.html"><img src="assets/imgs/page/homepage1/news3.png"
                                            alt="Genz"></a></div>
                                <div class="card-info">
                                    <div class="row">
                                        <div class="col-7"><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Design</a><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Movie</a>
                                        </div>
                                        <div class="col-5 text-end"><span class="color-gray-700 text-sm timeread">6 mins
                                                read</span></div>
                                    </div><a href="single-sidebar.html">
                                        <h5 class="color-white mt-20"> Self-observation is the first step of inner
                                            unfolding</h5>
                                    </a>
                                    <div class="row align-items-center mt-25">
                                        <div class="col-7">
                                            <div class="box-author"><img src="assets/imgs/page/homepage1/author3.png"
                                                    alt="Genz">
                                                <div class="author-info">
                                                    <h6 class="color-gray-700">Joseph</h6><span
                                                        class="color-gray-700 text-sm">27 Sep 2022</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 text-end"><a class="readmore color-gray-500 text-sm"
                                                href="single-sidebar.html"><span>Read more</span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="card-blog-1 hover-up">
                                <div class="card-image mb-20"><a class="post-type" href="blog-archive.html"></a><a
                                        href="single-sidebar.html"><img src="assets/imgs/page/homepage1/news3.png"
                                            alt="Genz"></a></div>
                                <div class="card-info">
                                    <div class="row">
                                        <div class="col-7"><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Design</a><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Movie</a>
                                        </div>
                                        <div class="col-5 text-end"><span class="color-gray-700 text-sm timeread">6 mins
                                                read</span></div>
                                    </div><a href="single-sidebar.html">
                                        <h5 class="color-white mt-20"> Self-observation is the first step of inner
                                            unfolding</h5>
                                    </a>
                                    <div class="row align-items-center mt-25">
                                        <div class="col-7">
                                            <div class="box-author"><img src="assets/imgs/page/homepage1/author3.png"
                                                    alt="Genz">
                                                <div class="author-info">
                                                    <h6 class="color-gray-700">Joseph</h6><span
                                                        class="color-gray-700 text-sm">27 Sep 2022</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 text-end"><a class="readmore color-gray-500 text-sm"
                                                href="single-sidebar.html"><span>Read more</span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="card-blog-1 hover-up">
                                <div class="card-image mb-20"><a class="post-type" href="blog-archive.html"></a><a
                                        href="single-sidebar.html"><img src="assets/imgs/page/homepage1/news3.png"
                                            alt="Genz"></a></div>
                                <div class="card-info">
                                    <div class="row">
                                        <div class="col-7"><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Design</a><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Movie</a>
                                        </div>
                                        <div class="col-5 text-end"><span class="color-gray-700 text-sm timeread">6 mins
                                                read</span></div>
                                    </div><a href="single-sidebar.html">
                                        <h5 class="color-white mt-20"> Self-observation is the first step of inner
                                            unfolding</h5>
                                    </a>
                                    <div class="row align-items-center mt-25">
                                        <div class="col-7">
                                            <div class="box-author"><img src="assets/imgs/page/homepage1/author3.png"
                                                    alt="Genz">
                                                <div class="author-info">
                                                    <h6 class="color-gray-700">Joseph</h6><span
                                                        class="color-gray-700 text-sm">27 Sep 2022</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 text-end"><a class="readmore color-gray-500 text-sm"
                                                href="single-sidebar.html"><span>Read more</span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="card-blog-1 hover-up">
                                <div class="card-image mb-20"><a class="post-type" href="blog-archive.html"></a><a
                                        href="single-sidebar.html"><img src="assets/imgs/page/homepage1/news3.png"
                                            alt="Genz"></a></div>
                                <div class="card-info">
                                    <div class="row">
                                        <div class="col-7"><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Design</a><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Movie</a>
                                        </div>
                                        <div class="col-5 text-end"><span class="color-gray-700 text-sm timeread">6 mins
                                                read</span></div>
                                    </div><a href="single-sidebar.html">
                                        <h5 class="color-white mt-20"> Self-observation is the first step of inner
                                            unfolding</h5>
                                    </a>
                                    <div class="row align-items-center mt-25">
                                        <div class="col-7">
                                            <div class="box-author"><img src="assets/imgs/page/homepage1/author3.png"
                                                    alt="Genz">
                                                <div class="author-info">
                                                    <h6 class="color-gray-700">Joseph</h6><span
                                                        class="color-gray-700 text-sm">27 Sep 2022</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 text-end"><a class="readmore color-gray-500 text-sm"
                                                href="single-sidebar.html"><span>Read more</span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="card-blog-1 hover-up">
                                <div class="card-image mb-20"><a class="post-type" href="blog-archive.html"></a><a
                                        href="single-sidebar.html"><img src="assets/imgs/page/homepage1/news3.png"
                                            alt="Genz"></a></div>
                                <div class="card-info">
                                    <div class="row">
                                        <div class="col-7"><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Design</a><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Movie</a>
                                        </div>
                                        <div class="col-5 text-end"><span class="color-gray-700 text-sm timeread">6 mins
                                                read</span></div>
                                    </div><a href="single-sidebar.html">
                                        <h5 class="color-white mt-20"> Self-observation is the first step of inner
                                            unfolding</h5>
                                    </a>
                                    <div class="row align-items-center mt-25">
                                        <div class="col-7">
                                            <div class="box-author"><img src="assets/imgs/page/homepage1/author3.png"
                                                    alt="Genz">
                                                <div class="author-info">
                                                    <h6 class="color-gray-700">Joseph</h6><span
                                                        class="color-gray-700 text-sm">27 Sep 2022</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 text-end"><a class="readmore color-gray-500 text-sm"
                                                href="single-sidebar.html"><span>Read more</span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="card-blog-1 hover-up">
                                <div class="card-image mb-20"><a class="post-type" href="blog-archive.html"></a><a
                                        href="single-sidebar.html"><img src="assets/imgs/page/homepage1/news3.png"
                                            alt="Genz"></a></div>
                                <div class="card-info">
                                    <div class="row">
                                        <div class="col-7"><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Design</a><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Movie</a>
                                        </div>
                                        <div class="col-5 text-end"><span class="color-gray-700 text-sm timeread">6 mins
                                                read</span></div>
                                    </div><a href="single-sidebar.html">
                                        <h5 class="color-white mt-20"> Self-observation is the first step of inner
                                            unfolding</h5>
                                    </a>
                                    <div class="row align-items-center mt-25">
                                        <div class="col-7">
                                            <div class="box-author"><img src="assets/imgs/page/homepage1/author3.png"
                                                    alt="Genz">
                                                <div class="author-info">
                                                    <h6 class="color-gray-700">Joseph</h6><span
                                                        class="color-gray-700 text-sm">27 Sep 2022</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 text-end"><a class="readmore color-gray-500 text-sm"
                                                href="single-sidebar.html"><span>Read more</span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="card-blog-1 hover-up">
                                <div class="card-image mb-20"><a class="post-type" href="blog-archive.html"></a><a
                                        href="single-sidebar.html"><img src="assets/imgs/page/homepage1/news3.png"
                                            alt="Genz"></a></div>
                                <div class="card-info">
                                    <div class="row">
                                        <div class="col-7"><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Design</a><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Movie</a>
                                        </div>
                                        <div class="col-5 text-end"><span class="color-gray-700 text-sm timeread">6 mins
                                                read</span></div>
                                    </div><a href="single-sidebar.html">
                                        <h5 class="color-white mt-20"> Self-observation is the first step of inner
                                            unfolding</h5>
                                    </a>
                                    <div class="row align-items-center mt-25">
                                        <div class="col-7">
                                            <div class="box-author"><img src="assets/imgs/page/homepage1/author3.png"
                                                    alt="Genz">
                                                <div class="author-info">
                                                    <h6 class="color-gray-700">Joseph</h6><span
                                                        class="color-gray-700 text-sm">27 Sep 2022</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 text-end"><a class="readmore color-gray-500 text-sm"
                                                href="single-sidebar.html"><span>Read more</span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="card-blog-1 hover-up">
                                <div class="card-image mb-20"><a class="post-type" href="blog-archive.html"></a><a
                                        href="single-sidebar.html"><img src="assets/imgs/page/homepage1/news3.png"
                                            alt="Genz"></a></div>
                                <div class="card-info">
                                    <div class="row">
                                        <div class="col-7"><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Design</a><a class="color-gray-700 text-sm" href="blog-archive.html">
                                                #Movie</a>
                                        </div>
                                        <div class="col-5 text-end"><span class="color-gray-700 text-sm timeread">6 mins
                                                read</span></div>
                                    </div><a href="single-sidebar.html">
                                        <h5 class="color-white mt-20"> Self-observation is the first step of inner
                                            unfolding</h5>
                                    </a>
                                    <div class="row align-items-center mt-25">
                                        <div class="col-7">
                                            <div class="box-author"><img src="assets/imgs/page/homepage1/author3.png"
                                                    alt="Genz">
                                                <div class="author-info">
                                                    <h6 class="color-gray-700">Joseph</h6><span
                                                        class="color-gray-700 text-sm">27 Sep 2022</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5 text-end"><a class="readmore color-gray-500 text-sm"
                                                href="single-sidebar.html"><span>Read more</span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-50">
                        <a class="btn btn-linear btn-load-more wow animate__animated animate__zoomIn">
                            {{ lang_db('Read More') }} <i class="fi-rr-arrow-small-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
