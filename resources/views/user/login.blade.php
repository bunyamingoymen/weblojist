@php
    $icon = getCachedKeyValue(['key' => 'logos', 'value' => 'Icon', 'first' => true]) ?? null;
    $meta = getCachedKeyValue(['key' => 'meta', 'delete' => true, 'first' => false]) ?? null;
    $admin_meta = getCachedKeyValue(['key' => 'admin_meta', 'delete' => true, 'first' => false]) ?? null;
    $loginLogo = getCachedKeyValue(['key' => 'logos', 'value' => 'Login Logo', 'first' => true]) ?? null;
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


    <title>Login | {{ env('APP_NAME') }}</title>
    <link rel="shortcut icon" href="{{ !is_null($icon) ? asset($icon->optional_5) : '' }}">

    <!-- App css -->
    <link rel="stylesheet" href="{{ route('assetFile', ['folder' => 'user/css', 'filename' => 'bootstrap.min.css']) }}">
    <link rel="stylesheet" href="{{ route('assetFile', ['folder' => 'user/css', 'filename' => 'icons.min.css']) }}">
    <link rel="stylesheet" href="{{ route('assetFile', ['folder' => 'user/css', 'filename' => 'app.min.css']) }}">

    <!-- alertifyjs Css -->
    <link
        href="{{ route('assetFile', ['folder' => 'admin/libs/alertifyjs/build/css', 'filename' => 'alertify.min.css']) }}"
        rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ route('assetFile', ['folder' => 'admin/libs/sweetalert2', 'filename' => 'sweetalert2.min.css']) }}"
        rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="text-center account-logo-box">
                            <div class="mt-2 mb-2">
                                <a href="{{ route('index.index') }}" class="text-success">
                                    <span><img src="{{ !is_null($loginLogo) ? asset($loginLogo->optional_5) : '' }}"
                                            alt="" height="36"></span>
                                </a>
                            </div>
                        </div>

                        <div class="card-body">

                            <form action="{{ route('user.login.post') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" type="text" id="username" name="username" required
                                        placeholder="{{ lang_db('Username or E-mail Address', 2) }}">
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="password" required="" id="password"
                                        name="password" placeholder="{{ lang_db('Password', 2) }}">
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox checkbox-success">
                                        <input type="checkbox" class="custom-control-input" id="checkbox-signin"
                                            checked>
                                        <label class="custom-control-label"
                                            for="checkbox-signin">{{ lang_db('Remember me', 2) }}</label>
                                    </div>
                                </div>

                                <div class="form-group text-center mt-4 pt-2">
                                    <div class="col-sm-12">
                                        <a href="page-recoverpw.html" class="text-muted"><i class="fa fa-lock mr-1"></i>
                                            {{ lang_db('Forgot your password?', 2) }}</a>
                                    </div>
                                </div>

                                <div class="form-group account-btn text-center mt-2">
                                    <div class="col-12">
                                        <button class="btn width-md btn-bordered btn-danger waves-effect waves-light"
                                            type="submit">{{ lang_db('Log In', 2) }}</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-5">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted">{{ lang_db("Don't have an account?", 2) }} <a
                                    href="{{ route('user.register') }}"
                                    class="text-primary ml-1"><b>{{ lang_db('Sign Up', 2) }}</b></a></p>
                        </div>
                    </div>

                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- Sweet Alerts js -->
    <script src="{{ route('assetFile', ['folder' => 'admin/libs/sweetalert2', 'filename' => 'sweetalert2.min.js']) }}">
    </script>

    <!-- alertifyjs js -->
    <script src="{{ route('assetFile', ['folder' => 'admin/libs/alertifyjs/build', 'filename' => 'alertify.min.js']) }}">
    </script>

    <script src="{{ route('assetFile', ['folder' => 'user/js', 'filename' => 'vendor.min.js']) }}"></script>

    <script src="{{ route('assetFile', ['folder' => 'user/js', 'filename' => 'app.min.js']) }}"></script>

    <!--Uyarı Mesajları-->
    <script>
        $(document).ready(function() {

            @if (session('success'))
                alertify.success("{{ lang_db(session('success'), 2) }}");
            @endif

            @if (session('error'))
                alertify.error("{{ lang_db(session('error'), 2) }}");
            @endif

            @if (session('warning'))
                alertify.warning("{{ lang_db(session('warning'), 2) }}");
            @endif
        });
    </script>


</body>

</html>
