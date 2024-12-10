@php
    $social_medias = getCachedKeyValue(['key' => 'social_media', 'delete' => true, 'first' => false]) ?? null;

    $footer_max_column = App\Models\Main\Menu::where('delete', 0)
        ->where('active', 1)
        ->where('type', 'footer')
        ->get()
        ->max(function ($menu) {
            return (int) $menu->column;
        });

    $footer_column_col = 'col-lg-4';

    if ($footer_max_column == 1) {
        $footer_column_col = 'col-lg-12';
    } elseif ($footer_max_column == 2) {
        $footer_column_col = 'col-lg-6';
    } elseif ($footer_max_column == 3) {
        $footer_column_col = 'col-lg-4';
    } elseif ($footer_max_column >= 4) {
        $footer_column_col = 'col-lg-3';
    }

    $footers = App\Models\Main\Menu::where('delete', 0)
        ->where('active', 1)
        ->where('type', 'footer')
        ->orderBy('row', 'ASC')
        ->get();

@endphp
<footer class="footer">
    <div class="container">
        <div class="footer-1 bg-gray-850 border-gray-800">

            @if ($footers->isNotEmpty())
                <div class="row">
                    @for ($i = 1; $i <= $footer_max_column; $i++)
                        @foreach ($footers->where('column', $i) as $footer)
                            <div class="{{ $footer_column_col }} mb-30">
                                @if ($footer->footer_type == 'image')
                                    <a class="wow animate__animated animate__fadeInUp" href="index.html">
                                        <img class="logo-night" src="{{ $footer->path }}" alt="{{ $footer->path }}">
                                        <img class="d-none logo-day" src="{{ $footer->title }}"
                                            alt="{{ $footer->title }}">
                                    </a>
                                @elseif ($footer->footer_type == 'text')
                                    <p
                                        class="mb-20 mt-20 text-sm color-gray-500 wow animate__animated animate__fadeInUp">
                                        {{ lang_db($footer->path, -1) }}
                                    </p>
                                @elseif ($footer->footer_type == 'title')
                                    <h6 class="color-white mb-5 wow animate__animated animate__fadeInUp">
                                        {{ lang_db($footer->path, -1) }}</h6>
                                @elseif($footer->footer_type == 'social_media')
                                @else
                                    <ul class="menu-footer">
                                        <li class="wow animate__animated animate__fadeInUp"><a class="color-gray-500"
                                                href="{{ url($footer->path) }}"
                                                {{ $footer->open_different_page ? 'target="_blank"' : '' }}>{{ lang_db($footer->title, -1) }}</a>
                                        </li>
                                    </ul>
                                    <br>
                                @endif
                            </div>
                        @endforeach
                    @endfor
                </div>
            @endif

            <div class="{{ $footers->isNotEmpty() ? 'footer-bottom' : '' }} border-gray-800">
                <div class="row">
                    <div class="col-lg-5 text-center text-lg-start">
                        <p class="text-base color-white wow animate__animated animate__fadeIn">© Created by<a
                                class="copyright" href="#"> {{ env('APP_NAME') }}</a>
                        </p>
                    </div>
                    <div class="col-lg-7 text-center text-lg-end">
                        <div class="box-socials">
                            @foreach ($social_medias as $media)
                                @if ($media->value == '' || is_null($media->value))
                                    @continue;
                                @endif
                                <div class="d-inline-block mr-15 wow animate__animated animate__fadeIn"
                                    data-wow-delay=".0s"><a
                                        class="icon-socials {{ $media->optional_6 ?? '' }} color-gray-500"
                                        href="{{ $media->value ?? '#' }}" target="_blank"></a></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="progressCounter progressScroll hover-up hover-neon-2">
    <div class="progressScroll-border">
        <div class="progressScroll-circle"><span class="progressScroll-text"><i class="fi-rr-arrow-small-up"></i></span>
        </div>
    </div>
</div>
