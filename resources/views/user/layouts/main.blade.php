@php
    $icon = getCachedKeyValue(['key' => 'logos', 'value' => 'Icon', 'first' => true]) ?? null;
    $meta = getCachedKeyValue(['key' => 'meta', 'delete' => true, 'first' => false]) ?? null;
    $admin_meta = getCachedKeyValue(['key' => 'admin_meta', 'delete' => true, 'first' => false]) ?? null;
@endphp

<!doctype html>
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

    <title>{{ env('APP_NAME') }} | {{ lang_db($title, 2) }} | User Panel</title>

    <link rel="shortcut icon" href="{{ !is_null($icon) ? asset($icon->optional_5) : '' }}">

    <link href="{{ route('assetFile', ['folder' => 'admin/css', 'filename' => 'bootstrap.min.css']) }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ route('assetFile', ['folder' => 'admin/css', 'filename' => 'icons.min.css']) }}" rel="stylesheet"
        type="text/css" />
    <link
        href="{{ route('assetFile', ['folder' => 'admin/libs/alertifyjs/build/css', 'filename' => 'alertify.min.css']) }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ route('assetFile', ['folder' => 'admin/libs/sweetalert2', 'filename' => 'sweetalert2.min.css']) }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ route('assetFile', ['folder' => 'admin/css', 'filename' => 'app.min.css']) }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ route('assetFile', ['folder' => 'admin/libs/slick-slider/slick', 'filename' => 'slick.css']) }}"
        rel="stylesheet" type="text/css" />
    <link
        href="{{ route('assetFile', ['folder' => 'admin/libs/slick-slider/slick', 'filename' => 'slick-theme.css']) }}"
        rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.3/styles/ag-grid.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.3/styles/ag-theme-quartz.css" />
    <script src="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.3/dist/ag-grid-community.min.js"></script>

</head>

<body data-sidebar="dark">

    <div id="layout-wrapper">

        @include('user.layouts.header')

        @include('user.layouts.sidebar')

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">


                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">{{ lang_db($title, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                    <div>
                        @yield('user_index_body')
                    </div>
                </div>
            </div>


            @include('user.layouts.footer')
        </div>

    </div>

    <div id="hiddenDiv" hidden>

    </div>

    <script src="{{ route('assetFile', ['folder' => 'admin/libs/jquery', 'filename' => 'jquery.min.js']) }}"></script>

    <script
        src="{{ route('assetFile', ['folder' => 'admin/libs/bootstrap/js', 'filename' => 'bootstrap.bundle.min.js']) }}">
    </script>

    <script src="{{ route('assetFile', ['folder' => 'admin/libs/metismenu', 'filename' => 'metisMenu.min.js']) }}">
    </script>
    <script src="{{ route('assetFile', ['folder' => 'admin/libs/simplebar', 'filename' => 'simplebar.min.js']) }}">
    </script>
    <script src="{{ route('assetFile', ['folder' => 'admin/libs/node-waves', 'filename' => 'waves.min.js']) }}"></script>
    <script src="{{ route('assetFile', ['folder' => 'admin/libs/tinymce', 'filename' => 'tinymce.min.js']) }}"></script>
    <script src="{{ route('assetFile', ['folder' => 'admin/libs/alertifyjs/build', 'filename' => 'alertify.min.js']) }}">
    </script>
    <script src="{{ route('assetFile', ['folder' => 'admin/libs/slick-slider/slick', 'filename' => 'slick.min.js']) }}">
    </script>
    <script src="{{ route('assetFile', ['folder' => 'admin/libs/sweetalert2', 'filename' => 'sweetalert2.min.js']) }}">
    </script>
    <script src="{{ route('assetFile', ['folder' => 'admin/js', 'filename' => 'app.js']) }}"></script>

    <script>
        $(document).ready(function() {

            @if (session('success'))
                alertify.success("{{ lang_db(session('success'), 2) }}");
            @endif

            @if (session('error'))
                alertify.error("{{ lang_db(session('error'), 2) }}");
            @endif

            @error('newPassword')
                alertify.error("{{ lang_db($message, 2) }}");
            @enderror

            @if (session('warning'))
                alertify.warning("{{ lang_db(session('warning'), 2) }}");
            @endif
        });
    </script>

    <script>
        var tiny_lang = "{{ getActiveLang() }}";
    </script>

    <script src="{{ route('assetFile', ['folder' => 'admin/js/pages', 'filename' => 'form-editor.init.js']) }}"></script>


</body>

</html>
