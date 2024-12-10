@php
    $icon = getCachedKeyValue(['key' => 'logos', 'value' => 'Icon', 'first' => true]) ?? null;
    $meta = getCachedKeyValue(['key' => 'meta', 'delete' => true, 'first' => false]) ?? null;
    $admin_meta = getCachedKeyValue(['key' => 'admin_meta', 'delete' => true, 'first' => false]) ?? null;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="msapplication-TileColor" content="#0E0E0E">
    <meta name="template-color" content="#0E0E0E">
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

    <link rel="shortcut icon" href="{{ !is_null($icon) ? asset($icon->optional_5) : '' }}">

    <link rel="stylesheet"
        href="{{ route('assetFile', ['folder' => 'index/genz/assets/css', 'filename' => 'style.css']) }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>{{ env('APP_NAME') }}</title>
</head>

<body>
    @include('index.genz.layouts.header')

    <main class="main">
        @yield('index_body')
    </main>

    @include('index.genz.layouts.footer')

    <script
        src="{{ route('assetFile', ['folder' => 'index/genz/assets/js/vendors', 'filename' => 'modernizr-3.6.0.min.js']) }}">
    </script>

    <script
        src="{{ route('assetFile', ['folder' => 'index/genz/assets/js/vendors', 'filename' => 'jquery-3.6.0.min.js']) }}">
    </script>

    <script
        src="{{ route('assetFile', ['folder' => 'index/genz/assets/js/vendors', 'filename' => 'jquery-migrate-3.3.0.min.js']) }}">
    </script>

    <script
        src="{{ route('assetFile', ['folder' => 'index/genz/assets/js/vendors', 'filename' => 'bootstrap.bundle.min.js']) }}">
    </script>

    <script src="{{ route('assetFile', ['folder' => 'index/genz/assets/js/vendors', 'filename' => 'waypoints.js']) }}">
    </script>

    <script src="{{ route('assetFile', ['folder' => 'index/genz/assets/js/vendors', 'filename' => 'wow.js']) }}"></script>

    <script src="{{ route('assetFile', ['folder' => 'index/genz/assets/js/vendors', 'filename' => 'text-type.js']) }}">
    </script>

    <script
        src="{{ route('assetFile', ['folder' => 'index/genz/assets/js/vendors', 'filename' => 'swiper-bundle.min.js']) }}">
    </script>

    <script
        src="{{ route('assetFile', ['folder' => 'index/genz/assets/js/vendors', 'filename' => 'jquery.progressScroll.min.js']) }}">
    </script>

    <script src="{{ route('assetFile', ['folder' => 'index/genz/assets/js', 'filename' => 'main.js']) }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/js/all.min.js"
        integrity="sha512-1JkMy1LR9bTo3psH+H4SV5bO2dFylgOy+UJhMus1zF4VEFuZVu5lsi4I6iIndE4N9p01z1554ZDcvMSjMaqCBQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>
