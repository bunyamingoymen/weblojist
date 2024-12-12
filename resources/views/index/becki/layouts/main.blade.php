@php
    $icon = getCachedKeyValue(['key' => 'logos', 'value' => 'Icon', 'first' => true]) ?? null;
    $meta = getCachedKeyValue(['key' => 'meta', 'delete' => true, 'first' => false]) ?? null;
    $admin_meta = getCachedKeyValue(['key' => 'admin_meta', 'delete' => true, 'first' => false]) ?? null;
    $show_main_langs = false;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    @if (isset($meta))
        @foreach ($meta as $item_meta)
            {!! $item_meta->value !!}
        @endforeach
    @endif
    @if (isset($admin_meta))
        @foreach ($admin_meta as $item_admin_meta)
            {!! $item_admin_meta->value !!}
        @endforeach
    @endif


    <title>{{ env('APP_NAME') }}</title>

    <link rel="shortcut icon" href="{{ !is_null($icon) ? asset($icon->optional_5) : '' }}">

    <link rel="stylesheet"
        href="{{ route('assetFile', ['folder' => 'index/becki/assets/css', 'filename' => 'master.css']) }}">
    <link rel="stylesheet"
        href="{{ route('assetFile', ['folder' => 'index/becki/assets/css', 'filename' => 'responsive.css']) }}">
    <link rel="stylesheet" type="text/css"
        href="{{ route('assetFile', ['folder' => 'index/becki/revolution/css', 'filename' => 'settings.css']) }}">
    <link rel="stylesheet" type="text/css"
        href="{{ route('assetFile', ['folder' => 'index/becki/revolution/css', 'filename' => 'layers.css']) }}">
    <link rel="stylesheet" type="text/css"
        href="{{ route('assetFile', ['folder' => 'index/becki/revolution/css', 'filename' => 'navigation.css']) }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="{{ route('assetFile', ['folder' => 'admin/libs/alertifyjs/build/css', 'filename' => 'alertify.min.css']) }}"
        rel="stylesheet" type="text/css" />

    <style>
        /* Mobil cihazlarda sadece gizlemek */
        @media screen and (max-width: 768px) {
            .mobile-hidden {
                display: none !important;
            }
        }
    </style>
    <!-- Yazı boyutlarını artırmak için head içine eklenecek custom CSS -->
    <style>
        /* Genel yazı boyutu artışı */
        p {
            font-size: 16px !important;
            line-height: 1.8 !important;
        }

        /* Başlık boyutlarını artır */
        .section-title h1 {
            font-size: 42px !important;
            margin-bottom: 25px;
        }

        .section-title h2 {
            font-size: 24px !important;
        }

        /* Contact form stillerini güncelle */
        .contact-form-style-01 {
            background: #f8f9fa;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }

        .contact-form-style-01 input,
        .contact-form-style-01 textarea,
        .contact-form-style-01 select {
            background: #fff !important;
            border: 1px solid #e1e1e1 !important;
            padding: 12px 15px !important;
            border-radius: 4px !important;
            color: #333 !important;
            font-size: 15px !important;
        }

        .contact-form-style-01 input:focus,
        .contact-form-style-01 textarea:focus {
            border-color: #2055c7 !important;
            box-shadow: 0 0 5px rgba(32, 85, 199, 0.2);
        }

        /* Menü yazı boyutlarını artır */
        .navbar-nav>li>a {
            font-size: 15px !important;
        }

        /* Servis kartları için gölge ve hover efekti */
        .feature-box {
            transition: all 0.3s ease;
            padding: 30px;
            border-radius: 8px;
        }

        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Testimonial kartları için stil güncellemesi */
        .testimonial-item {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        /* Portfolio hover efektini güçlendir */
        .portfolio-info {
            opacity: 0;
            transition: all 0.4s ease;
        }

        .portfolio-item:hover .portfolio-info {
            opacity: 1;
        }

        /* Button stillerini güncelle */
        .btn {
            padding: 12px 30px !important;
            font-size: 15px !important;
            font-weight: 500 !important;
        }

        /* Footer yazı boyutunu artır */
        .footer {
            font-size: 15px !important;
        }
    </style>
</head>

<body>
    @if (isset($main_flag) && isset($other_flags) && $main_flag != '-1' && $show_main_langs)
        <div class="top-language-bar mobile-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-right">
                        <div class="language-selector">
                            @foreach ($other_flags as $flag)
                                <a href="{{ route('Translation.setActiveLang', ['locale' => $flag->optional_1]) }}"
                                    class="lang-option">
                                    <img src="{{ asset($flag->optional_5) }}" alt="">
                                </a>
                                @if (!$loop->last)
                                    <span class="separator">|</span>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div id="loader-overlay">
        <div class="loader">
            <div class="spinner">
                <svg viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle class="length" fill="none" stroke-width="8" stroke-linecap="round" cx="33"
                        cy="33" r="28"></circle>
                </svg>
                <svg viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle fill="none" stroke-width="8" stroke-linecap="round" cx="33" cy="33" r="28">
                    </circle>
                </svg>
                <svg viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle fill="none" stroke-width="8" stroke-linecap="round" cx="33" cy="33" r="28">
                    </circle>
                </svg>
                <svg viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle fill="none" stroke-width="8" stroke-linecap="round" cx="33" cy="33" r="28">
                    </circle>
                </svg>
            </div>
        </div>
    </div>

    <div class="wrapper">

        @include('index.becki.layouts.header')

        @yield('index_body')

        @include('index.becki.layouts.footer')

        <a href="javascript:" id="return-to-top"><i class="icofont icofont-arrow-up"></i></a>

    </div>

    <script src="{{ route('assetFile', ['folder' => 'index/becki/assets/js', 'filename' => 'jquery.min.js']) }}"></script>
    <script src="{{ route('assetFile', ['folder' => 'index/becki/assets/js', 'filename' => 'smoothscroll.js']) }}">
    </script>
    <script src="{{ route('assetFile', ['folder' => 'index/becki/assets/js', 'filename' => 'plugins.js']) }}"></script>
    <script src="{{ route('assetFile', ['folder' => 'index/becki/assets/js', 'filename' => 'master.js']) }}"></script>

    <script
        src="{{ route('assetFile', ['folder' => 'index/becki/revolution/js', 'filename' => 'jquery.themepunch.tools.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/becki/revolution/js', 'filename' => 'jquery.themepunch.revolution.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/becki/revolution/js', 'filename' => 'revolution.extension.actions.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/becki/revolution/js', 'filename' => 'revolution.extension.carousel.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/becki/revolution/js', 'filename' => 'revolution.extension.kenburn.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/becki/revolution/js', 'filename' => 'revolution.extension.layeranimation.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/becki/revolution/js', 'filename' => 'revolution.extension.migration.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/becki/revolution/js', 'filename' => 'revolution.extension.navigation.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/becki/revolution/js', 'filename' => 'revolution.extension.parallax.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/becki/revolution/js', 'filename' => 'revolution.extension.slideanims.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/becki/revolution/js', 'filename' => 'revolution.extension.video.min.js']) }}">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/js/all.min.js"
        integrity="sha512-1JkMy1LR9bTo3psH+H4SV5bO2dFylgOy+UJhMus1zF4VEFuZVu5lsi4I6iIndE4N9p01z1554ZDcvMSjMaqCBQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{ route('assetFile', ['folder' => 'admin/libs/alertifyjs/build', 'filename' => 'alertify.min.js']) }}">
    </script>

    <script>
        $(function() {
            $('#contact-form').validator();

            $('#contact-form').on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    var url = "{{ route('index.sendMessage') }}";
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.class && response.message) {
                                var alertBox = '<div class="' + response.class +
                                    ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' +
                                    response.message + '</div>';
                                $('#contact-form').find('.messages').html(alertBox);
                                $('#contact-form')[0].reset();
                            }
                        }
                    });
                    return false;
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            if (document.getElementsByClassName('html5-video')[0]) {
                document.getElementsByClassName('html5-video')[0].play();
            }


            @if (session('success'))
                alertify.success("{{ lang_db(session('success'), 1) }}");
            @endif

            @if (session('error'))
                alertify.error("{{ lang_db(session('error'), 1) }}");
            @endif

            @if (session('warning'))
                alertify.warning("{{ lang_db(session('warning'), 1) }}");
            @endif
        });
    </script>

    @yield('index_script')

</body>

</html>
