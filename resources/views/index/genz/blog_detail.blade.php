@extends('index.genz.layouts.main')
@section('index_body')
    @php

        if ($page->created_at) {
            $date = \Carbon\Carbon::parse($page->created_at);
            $day = $date->format('d');
            $month = lang_db($date->format('F'), 1); // Ayı dil dosyasından çekiyoruz
            $year = $date->format('Y');
            $result_date = $day . ' ' . $month . ' ' . $year;
        } else {
            $result_date = '';
        }

        $url = $page->short_name ?? 'not-found';
    @endphp
    <div class="cover-home3">
        <div class="container">
            <div class="row">
                <div class="col-xl-1"></div>
                <div class="col-xl-10 col-lg-12">
                    <div class="pt-30 border-bottom border-gray-800 pb-20">
                        <div class="box-breadcrumbs">
                            <ul class="breadcrumb">
                                <li><a class="home" href="{{ route('index.index') }}">{{ lang_db('Home', 1) }}</a></li>
                                <li><a href="{{ route('index.blogs') }}">{{ lang_db('Blog', 1) }}</a></li>
                                <li><span>{{ $page->title }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-50 align-items-end">
                        <div class="col-lg-8 m-auto text-center">
                            <h2 class="color-linear">{{ $page->title }}</h2>
                        </div>
                    </div>
                    <div class="row mt-30">
                        <div class="col-lg-12">
                            <div class="image-detail mb-30">
                                <img class="bdrd16" src="{{ $page->image ? asset($page->image) : '' }}" alt="Genz">
                            </div>
                        </div>
                        <div class="col-lg-8 m-auto">
                            <div class="row mb-40">
                                @if (
                                    (isset($show_date_on_its_own) && $show_date_on_its_own->optional_1) ||
                                        (isset($show_author_on_its_own) && $show_author_on_its_own->optional_1))
                                    <div class="col-md-6 mb-10">
                                        <div class="box-author"><img
                                                src="{{ $page->admin_image ? asset($page->admin_image) : '' }}"
                                                alt="{{ $page->admin_image ?? '' }}">
                                            <div class="author-info">
                                                <h6 class="color-gray-700">{{ $page->admin_name ?? '' }}</h6>
                                                <span class="color-gray-700 text-sm mr-30">{{ $result_date }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div
                                    class="{{ (isset($show_date_on_its_own) && $show_date_on_its_own->optional_1) || (isset($show_author_on_its_own) && $show_author_on_its_own->optional_1) ? 'col-md-6' : 'col-md-12' }}
                                    text-start text-md-end">
                                    <div class="d-inline-block pt-10">
                                        <div class="d-flex align-item-center">
                                            <h6 class="d-inline-block color-gray-500 mr-10">{{ lang_db('Share', 1) }}</h6>
                                            <a class="icon-media icon-fb" href="#"></a>
                                            <a class="icon-media icon-tw" href="#"></a>
                                            <a class="icon-media icon-printest" href="#"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-detail border-gray-800">
                                {!! $page->description ? lang_db($page->description, -1) : '' !!}
                            </div>
                            @if (false)
                                <!--FIXME: Burası daha sonradan aktif olması gerek-->

                                <!--Etiketler, kategoriler-->
                                <div class="box-tags"><a class="btn btn-tags bg-gray-850 border-gray-800 mr-10 hover-up"
                                        href="blog-archive.html">#Nature</a><a
                                        class="btn btn-tags bg-gray-850 border-gray-800 mr-10 hover-up"
                                        href="blog-archive.html">#Beauty</a><a
                                        class="btn btn-tags bg-gray-850 border-gray-800 mr-10 hover-up"
                                        href="blog-archive.html">#Travel Tips</a><a
                                        class="btn btn-tags bg-gray-850 border-gray-800 hover-up"
                                        href="blog-archive.html">#House</a>
                                </div>
                                <!--Yorumlar-->
                                <div class="box-comments border-gray-800">
                                    <h3 class="text-heading-2 color-gray-300">Comments</h3>
                                    <div class="list-comments-single">
                                        <div class="item-comment">
                                            <div class="comment-left">
                                                <div class="box-author mb-20"><img src="assets/imgs/page/single/author.png"
                                                        alt="Genz">
                                                    <div class="author-info">
                                                        <h6 class="color-gray-700">Robert Fox</h6><span
                                                            class="color-gray-700 text-sm mr-30">August 25, 2022</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="comment-right">
                                                <div
                                                    class="text-comment text-xl color-gray-500 bg-gray-850 border-gray-800">
                                                    White white dreamy drama tically place everything although. Place out
                                                    apartment afternoon whimsical kinder, little romantic joy we flowers
                                                    handmade.</div>
                                            </div>
                                        </div>
                                        <div class="item-comment">
                                            <div class="comment-left">
                                                <div class="box-author mb-20"><img src="assets/imgs/page/single/author2.png"
                                                        alt="Genz">
                                                    <div class="author-info">
                                                        <h6 class="color-gray-700">Jenny Wilson</h6><span
                                                            class="color-gray-700 text-sm mr-30">August 25, 2022</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="comment-right">
                                                <div
                                                    class="text-comment text-xl color-gray-500 bg-gray-850 border-gray-800">
                                                    White white dreamy drama tically place everything although. Place out
                                                    apartment afternoon whimsical kinder, little romantic joy we flowers
                                                    handmade.</div>
                                            </div>
                                        </div>
                                        <div class="item-comment item-comment-sub">
                                            <div class="comment-left">
                                                <div class="box-author mb-20"><img src="assets/imgs/page/single/author3.png"
                                                        alt="Genz">
                                                    <div class="author-info">
                                                        <h6 class="color-gray-700">Eleanor Pena</h6><span
                                                            class="color-gray-700 text-sm mr-30">August 25, 2022</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="comment-right">
                                                <div
                                                    class="text-comment text-xl color-gray-500 bg-gray-850 border-gray-800">
                                                    White white dreamy drama tically place everything although. Place out
                                                    apartment afternoon whimsical kinder, little romantic joy we flowers
                                                    handmade.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Yorum yapma kısmı-->
                                <div class="box-form-comments mb-50">
                                    <h4 class="text-heading-4 color-gray-300 mb-40">Leave a comment</h4>
                                    <div class="box-forms">
                                        <form action="#">
                                            <textarea class="form-control bg-gray-850 border-gray-800 bdrd16 color-gray-500" name="comment" rows="5"
                                                placeholder="Write a comment"></textarea>
                                            <div class="row mt-20">
                                                <div class="col-sm-6 mb-20">
                                                    <input class="cb-agree" type="checkbox">
                                                    <p class="text-sm color-gray-500 pl-25">Save my name, email, and
                                                        website in
                                                        this browser for the next time I comment.</p>
                                                </div>
                                                <div class="col-sm-6 text-end"><a class="btn btn-linear">Post Comment</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
