@php
    $home_logo_white = getCachedKeyValue(['key' => 'logos', 'value' => 'Home Logo White', 'first' => true]) ?? null;
    $home_logo_dark = getCachedKeyValue(['key' => 'logos', 'value' => 'Home Logo Dark', 'first' => true]) ?? null;

    $headers = App\Models\Main\Menu::where('delete', 0)
        ->where('active', 1)
        ->where('type', 'header')
        ->orderBy('row', 'ASC')
        ->get();
    if (Route::currentRouteName() == '') {
        $use_theme = 'dark';
    } else {
        $use_theme_db = getCachedKeyValue(['key' => 'header_theme', 'first' => true, 'refreshCache' => true]) ?? null;
        $use_theme = $use_theme_db ? $use_theme_db->value : 'dark';
    }
@endphp

<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="text-center"><img class="mb-10" src="assets/imgs/template/favicon.svg" alt="GenZ">
                <div class="preloader-dots"></div>
            </div>
        </div>
    </div>
</div>

<header class="header sticky-bar">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-xl-1"></div>
            <div class="col-xl-10 col-lg-12">
                <div class="main-header">
                    <div class="header-logo"><a class="d-flex" href="{{ route('index.index') }}"><img class="logo-night"
                                alt="GenZ"
                                src="{{ !is_null($home_logo_white) && $home_logo_white->optional_5 ? asset($home_logo_white->optional_5) : '' }}"><img
                                class="d-none logo-day" alt="GenZ"
                                src="{{ !is_null($home_logo_dark) && $home_logo_dark->optional_5 ? asset($home_logo_dark->optional_5) : '' }}"></a>
                    </div>
                    <div class="header-nav">
                        <nav class="nav-main-menu d-none d-xl-block">
                            <ul class="main-menu">
                                @foreach ($headers->where('top_category', '0') as $header)
                                    <li
                                        class="{{ count($headers->where('top_category', $header->code)) > 0 ? 'has-children' : '' }}">
                                        <a class="color-gray-500" href="{{ url($header->path) }}"
                                            {{ $header->open_different_page ? 'target="_blank"' : '' }}>
                                            {{ lang_db($header->title, -1) }}</a>
                                        @if (count($headers->where('top_category', $header->code)) > 0)
                                            <ul class="sub-menu">
                                                @foreach ($headers->where('top_category', $header->code) as $header_alt)
                                                    <li>
                                                        <a class="color-gray-500" href="{{ url($header_alt->path) }}"
                                                            {{ $header_alt->open_different_page ? 'target="_blank"' : '' }}>
                                                            {{ lang_db($header_alt->title, -1) }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                        <div class="burger-icon burger-icon-white"><span class="burger-icon-top"></span><span
                                class="burger-icon-mid"></span><span class="burger-icon-bottom"></span></div>
                    </div>
                    @if (false)
                        <div class="header-right text-end"><a class="btn btn-search" href="#"></a>
                            <div class="form-search p-20">
                                <form action="#">
                                    <input class="form-control" type="text" placeholder="Search">
                                    <input class="btn-search-2" type="submit" value="">
                                </form>
                                <div class="popular-keywords text-start mt-20">
                                    <p class="mb-10 color-white">Popular tags:</p><a
                                        class="color-gray-600 mr-10 font-xs" href="#"># Travel,</a><a
                                        class="color-gray-600 mr-10 font-xs" href="#"># Tech,</a><a
                                        class="color-gray-600 mr-10 font-xs" href="#"># Movie</a><a
                                        class="color-gray-600 mr-10 font-xs" href="#"># Lifestyle</a><a
                                        class="color-gray-600 mr-10 font-xs" href="#"># Sport</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="header-right text-end">
                        <!--Bu kısım yukarıdadaki div'e ait ancak arama özelliği bulunmadığı için ayrı kondu. Arama eklendiğinde yukarı taşı-->
                        <div class="switch-button">
                            <div class="form-check form-switch">
                                <input class="form-check-input" id="flexSwitchCheckChecked" type="checkbox"
                                    role="switch" checked="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar bg-gray-900">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-content-area">
            <div class="mobile-logo border-gray-800"><a class="d-flex" href="index.html"><img class="logo-night"
                        alt="GenZ" src="assets/imgs/template/logo.svg"><img class="d-none logo-day" alt="GenZ"
                        src="assets/imgs/template/logo-day.svg"></a></div>
            <div class="perfect-scroll">
                <div class="mobile-menu-wrap mobile-header-border">
                    <nav class="mt-15">
                        <ul class="mobile-menu font-heading">
                            @foreach ($headers->where('top_category', '0') as $header)
                                <li
                                    class="{{ count($headers->where('top_category', $header->code)) > 0 ? 'has-children' : '' }}">
                                    <a class="color-gray-500" href="{{ url($header->path) }}"
                                        {{ $header->open_different_page ? 'target="_blank"' : '' }}>
                                        {{ lang_db($header->title, -1) }}</a>
                                    @if (count($headers->where('top_category', $header->code)) > 0)
                                        <ul class="sub-menu">
                                            @foreach ($headers->where('top_category', $header->code) as $header_alt)
                                                <li>
                                                    <a class="color-gray-500" href="{{ url($header_alt->path) }}"
                                                        {{ $header_alt->open_different_page ? 'target="_blank"' : '' }}>
                                                        {{ lang_db($header_alt->title, -1) }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </nav>
                </div>

                <div class="site-copyright color-gray-400 mt-30">Copyright 2024 &copy; {{ env('APP_NAME') }}
                    <br>
                    Designed by<a href="#" target="_blank">&nbsp; {{ env('APP_NAME') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
