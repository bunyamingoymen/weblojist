@php
    $show_whatsapp = getCachedKeyValue(['key' => 'show_whatsapp', 'first' => true, 'refreshCache' => true]) ?? null;
    $whatsapp_phone = getCachedKeyValue(['key' => 'whatsapp_phone', 'first' => true, 'refreshCache' => true]) ?? null;

    $social_medias = getCachedKeyValue(['key' => 'social_media', 'delete' => true, 'first' => false]) ?? null;

    $footer_one = App\Models\Main\Menu::where('delete', 0)
        ->where('active', 1)
        ->where('type', 'footer')
        ->where('column', '1')
        ->get();

    $footer_two = App\Models\Main\Menu::where('delete', 0)
        ->where('active', 1)
        ->where('type', 'footer')
        ->where('column', '2')
        ->get();

    $footer_three = App\Models\Main\Menu::where('delete', 0)
        ->where('active', 1)
        ->where('type', 'footer')
        ->where('column', '3')
        ->get();

    $footer_four = App\Models\Main\Menu::where('delete', 0)
        ->where('active', 1)
        ->where('type', 'footer')
        ->where('column', '4')
        ->get();
@endphp

@if (isset($show_whatsapp) && isset($whatsapp_phone) && $show_whatsapp->value && $whatsapp_phone->value)
    <a href="https://wa.me/{{ $whatsapp_phone->value }}" class="whatsapp-support" target="_blank">
        <div class="whatsapp-support-icon">
            <i class="icofont icofont-brand-whatsapp"></i>
        </div>
        <div class="whatsapp-support-text">
            <span>{{ lang_db('Reach us on WhatsApp!') }}</span>
        </div>
    </a>
@endif

<footer class="footer">
    @if (
        ($footer_one && $footer_one->isNotEmpty()) ||
            ($footer_two && $footer_two->isNotEmpty()) ||
            ($footer_three && $footer_three->isNotEmpty()) ||
            ($footer_four && $footer_four->isNotEmpty()))
        <div class="footer-main">
            <div class="container">
                <div class="row">
                    @if ($footer_one)
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="footer-widget">
                                <ul class="footer-links">
                                    @foreach ($footer_one as $foo)
                                        <li>
                                            <a href="{{ url($foo->path) }}"
                                                {{ $foo->open_different_page ? 'target="_blank"' : '' }}>{{ lang_db($foo->title, -1) }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif


                    @if ($footer_two)
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="footer-widget">
                                <ul class="footer-links">
                                    @foreach ($footer_two as $foo)
                                        <li>
                                            <a href="{{ url($foo->path) }}"
                                                {{ $foo->open_different_page ? 'target="_blank"' : '' }}>{{ lang_db($foo->title, -1) }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if ($footer_three)
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="footer-widget">
                                <ul class="footer-links">
                                    @foreach ($footer_three as $foo)
                                        <li>
                                            <a href="{{ url($foo->path) }}"
                                                {{ $foo->open_different_page ? 'target="_blank"' : '' }}>{{ lang_db($foo->title, -1) }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if ($footer_four)
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="footer-widget">
                                <ul class="footer-links">
                                    @foreach ($footer_four as $foo)
                                        <li>
                                            <a href="{{ url($foo->path) }}"
                                                {{ $foo->open_different_page ? 'target="_blank"' : '' }}>{{ lang_db($foo->title, -1) }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="copy-right text-left">© 2024 {{ env('APP_NAME') }}. All rights reserved</div>
                </div>
                @if (isset($social_medias) && $social_medias->isNotEmpty())
                    <div class="col-md-6 col-xs-12">
                        <ul class="social-media">
                            @foreach ($social_medias as $media)
                                @if ($media->value == '' || is_null($media->value))
                                    @continue;
                                @endif
                                <li>
                                    <a href="{{ $media->value ?? '#' }}" class="" target="_blank">
                                        <i class="{{ $media->optional_4 ?? '' }}"></i>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
        </div>
    </div>
</footer>
