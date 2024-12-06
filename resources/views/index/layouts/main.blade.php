@php
    $icon = getCachedKeyValue(['key' => 'logos', 'value' => 'Icon', 'first' => true]) ?? null;
    $meta = getCachedKeyValue(['key' => 'meta', 'delete' => true, 'first' => false]) ?? null;
    $admin_meta = getCachedKeyValue(['key' => 'admin_meta', 'delete' => true, 'first' => false]) ?? null;
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

    <!-- Core Style Sheets -->
    <link rel="stylesheet" href="{{ route('assetFile', ['folder' => 'index/assets/css', 'filename' => 'master.css']) }}">
    <!-- Responsive Style Sheets -->
    <link rel="stylesheet"
        href="{{ route('assetFile', ['folder' => 'index/assets/css', 'filename' => 'responsive.css']) }}">
    <!-- Revolution Style Sheets -->
    <link rel="stylesheet" type="text/css"
        href="{{ route('assetFile', ['folder' => 'index/revolution/css', 'filename' => 'settings.css']) }}">
    <link rel="stylesheet" type="text/css"
        href="{{ route('assetFile', ['folder' => 'index/revolution/css', 'filename' => 'layers.css']) }}">
    <link rel="stylesheet" type="text/css"
        href="{{ route('assetFile', ['folder' => 'index/revolution/css', 'filename' => 'navigation.css']) }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- alertifyjs Css -->
    <link
        href="{{ route('assetFile', ['folder' => 'admin/libs/alertifyjs/build/css', 'filename' => 'alertify.min.css']) }}"
        rel="stylesheet" type="text/css" />

</head>

<body>
    @if (isset($main_flag) && isset($other_flags) && $main_flag != '-1')
        <!--== Top Language Bar Start ==-->
        <div class="top-language-bar">
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
        <!--== Top Language Bar End ==-->
    @endif
    <!--== Loader Start ==-->
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
    <!--== Loader End ==-->

    <!--== Wrapper Start ==-->
    <div class="wrapper">

        <!--== Header Start ==-->
        @include('index.layouts.header')
        <!--== Header End ==-->

        @yield('index_body')

        <!--== Footer Start ==-->
        @include('index.layouts.footer')
        <!--== Footer End ==-->

        <!--== Go to Top  ==-->
        <a href="javascript:" id="return-to-top"><i class="icofont icofont-arrow-up"></i></a>
        <!--== Go to Top End ==-->

    </div>
    <!--== Wrapper End ==-->

    <!--== Javascript Plugins ==-->
    <script src="{{ route('assetFile', ['folder' => 'index/assets/js', 'filename' => 'jquery.min.js']) }}"></script>
    <script src="{{ route('assetFile', ['folder' => 'index/assets/js', 'filename' => 'smoothscroll.js']) }}"></script>
    <script src="{{ route('assetFile', ['folder' => 'index/assets/js', 'filename' => 'plugins.js']) }}"></script>
    <script src="{{ route('assetFile', ['folder' => 'index/assets/js', 'filename' => 'master.js']) }}"></script>

    <!-- Particles add on Files -->
    @yield('index_script')

    <!-- Revolution js Files -->
    <script
        src="{{ route('assetFile', ['folder' => 'index/revolution/js', 'filename' => 'jquery.themepunch.tools.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/revolution/js', 'filename' => 'jquery.themepunch.revolution.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/revolution/js', 'filename' => 'revolution.extension.actions.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/revolution/js', 'filename' => 'revolution.extension.carousel.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/revolution/js', 'filename' => 'revolution.extension.kenburn.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/revolution/js', 'filename' => 'revolution.extension.layeranimation.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/revolution/js', 'filename' => 'revolution.extension.migration.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/revolution/js', 'filename' => 'revolution.extension.navigation.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/revolution/js', 'filename' => 'revolution.extension.parallax.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/revolution/js', 'filename' => 'revolution.extension.slideanims.min.js']) }}">
    </script>
    <script
        src="{{ route('assetFile', ['folder' => 'index/revolution/js', 'filename' => 'revolution.extension.video.min.js']) }}">
    </script>
    <!--== Javascript Plugins End ==-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/js/all.min.js"
        integrity="sha512-1JkMy1LR9bTo3psH+H4SV5bO2dFylgOy+UJhMus1zF4VEFuZVu5lsi4I6iIndE4N9p01z1554ZDcvMSjMaqCBQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- alertifyjs js -->
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

    <!--Uyarı Mesajları-->
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

</body>

</html>
