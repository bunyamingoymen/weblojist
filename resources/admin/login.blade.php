@php
    $icon = getCachedKeyValue(['key' => 'logos', 'value' => 'Icon', 'first' => true]) ?? null;
    $meta = getCachedKeyValue(['key' => 'meta', 'delete' => true, 'first' => false]) ?? null;
    $admin_meta = getCachedKeyValue(['key' => 'admin_meta', 'delete' => true, 'first' => false]) ?? null;
    $admin_login = getCachedKeyValue(['key' => 'logos', 'value' => 'Admin Login Logo', 'first' => true]) ?? null;
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

    <title>{{ env('APP_NAME') }} | {{ lang_db($title) }} | Admin Panel</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ !is_null($icon) ? asset($icon->optional_5) : '' }}">

    <!-- Bootstrap Css -->
    <link href="{{ route('assetFile', ['folder' => 'admin/css', 'filename' => 'bootstrap.min.css']) }}" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ route('assetFile', ['folder' => 'admin/css', 'filename' => 'icons.min.css']) }}" rel="stylesheet"
        type="text/css" />
    <!-- App Css-->
    <link href="{{ route('assetFile', ['folder' => 'admin/css', 'filename' => 'app.min.css']) }}" rel="stylesheet"
        type="text/css" />

    <!-- alertifyjs Css -->
    <link
        href="{{ route('assetFile', ['folder' => 'admin/libs/alertifyjs/build/css', 'filename' => 'alertify.min.css']) }}"
        rel="stylesheet" type="text/css" />

</head>

<body class="bg-primary bg-pattern">

    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <a href="{{ route('index.index') }}" class="logo"><img
                                src="{{ !is_null($admin_login) ? asset($admin_login->optional_5) : '' }}" height="55"
                                alt="logo"></a>
                        <h5 class="font-size-16 text-white-50 mb-4"></h5>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="p-2">
                                <h5 class="mb-5 text-center">{{ lang_db('Sign in to continue') }}</h5>
                                <form class="form-horizontal" action="{{ route('admin_page', ['params' => 'login']) }}"
                                    method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-4">
                                                <label for="username">{{ lang_db('Username') }}: </label>
                                                <input type="text" class="form-control" id="username"
                                                    name="username"
                                                    placeholder="{{ lang_db('Enter username or email') }}">
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="password">{{ lang_db('Password') }}: </label>
                                                <input type="password" class="form-control" id="password"
                                                    name="password" placeholder="{{ lang_db('Enter password') }}">
                                            </div>

                                            <div class="mt-4">
                                                <button class="btn btn-success btn-block waves-effect waves-light"
                                                    type="submit">{{ lang_db('Log In') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
    <!-- end Account pages -->

    <!-- JAVASCRIPT -->
    <script src="{{ route('assetFile', ['folder' => 'admin/libs/jquery', 'filename' => 'jquery.min.js']) }}"></script>
    <script
        src="{{ route('assetFile', ['folder' => 'admin/libs/bootstrap/js', 'filename' => 'bootstrap.bundle.min.js']) }}">
    </script>
    <script src="{{ route('assetFile', ['folder' => 'admin/libs/metismenu', 'filename' => 'metisMenu.min.js']) }}">
    </script>
    <script src="{{ route('assetFile', ['folder' => 'admin/libs/simplebar', 'filename' => 'simplebar.min.js']) }}">
    </script>

    <script src="{{ route('assetFile', ['folder' => 'admin/libs/node-waves', 'filename' => 'waves.min.js']) }}"></script>

    <!-- alertifyjs js -->
    <script src="{{ route('assetFile', ['folder' => 'admin/libs/alertifyjs/build', 'filename' => 'alertify.min.js']) }}">
    </script>

    <script src="{{ route('assetFile', ['folder' => 'admin/js', 'filename' => 'app.js']) }}"></script>

    <!--Uyarı Mesajları-->
    <script>
        $(document).ready(function() {
            @if (session('success'))
                alertify.success("{{ lang_db(session('success')) }}");
            @endif

            @if (session('error'))
                alertify.error("{{ lang_db(session('error')) }}");
            @endif

            @if (session('warning'))
                alertify.warning("{{ lang_db(session('warning')) }}");
            @endif
        });
    </script>

</body>

</html>
