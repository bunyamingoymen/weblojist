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

    <!-- Sweet Alert-->
    <link href="{{ route('assetFile', ['folder' => 'user/libs/sweetalert2', 'filename' => 'sweetalert2.min.css']) }}"
        rel="stylesheet" type="text/css" />


    <!-- alertifyjs Css -->
    <link
        href="{{ route('assetFile', ['folder' => 'admin/libs/alertifyjs/build/css', 'filename' => 'alertify.min.css']) }}"
        rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link rel="stylesheet" href="{{ route('assetFile', ['folder' => 'user/css', 'filename' => 'bootstrap.min.css']) }}">
    <link rel="stylesheet" href="{{ route('assetFile', ['folder' => 'user/css', 'filename' => 'icons.min.css']) }}">
    <link rel="stylesheet" href="{{ route('assetFile', ['folder' => 'user/css', 'filename' => 'app.min.css']) }}">



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

                            <form action="{{ route('user.register.post') }}" method="POST" id="registerFormID">
                                @csrf

                                <div class="form-group">
                                    <input class="form-control" type="text" id="name" name="name" required
                                        placeholder="{{ lang_db('Name', 2) }}">
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="text" id="email" name="email" required
                                        placeholder="{{ lang_db('E-Mail', 2) }}">
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="text" id="username" name="username" required
                                        placeholder="{{ lang_db('Username', 2) }}">
                                </div>


                                <div class="form-group">
                                    <input class="form-control" type="password" required="" id="password"
                                        name="password" placeholder="{{ lang_db('Password', 2) }}">
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="password" required="" id="repeat_password"
                                        name="repeat_password" placeholder="{{ lang_db('Repeat password', 2) }}">
                                </div>

                                <div class="form-group">
                                    <div class="checkbox checkbox-success pt-1 pl-1">
                                        <input id="checkbox-signup" type="checkbox" checked="checked">
                                        <label for="checkbox-signup" class="mb-0"><a
                                                href="{{ route('index.blog.detail', ['pageCode' => 'terms_and_conditions']) }}"
                                                target="_blank">{{ lang_db('Terms and Conditions', 2) }}</a></label>
                                    </div>
                                </div>

                                <div class="form-group account-btn text-center mt-2">
                                    <div class="col-12">
                                        <button class="btn width-md btn-bordered btn-danger waves-effect waves-light"
                                            type="button" onclick="submitEdit()">{{ lang_db('Sign Up', 2) }}</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-5">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted">{{ lang_db('Already have account?', 2) }} <a
                                    href="{{ route('user.login') }}"
                                    class="text-primary ml-1"><b>{{ lang_db('Log In', 2) }}</b></a></p>
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

    <script src="{{ route('assetFile', ['folder' => 'user/js', 'filename' => 'vendor.min.js']) }}"></script>


    <!-- alertifyjs js -->
    <script src="{{ route('assetFile', ['folder' => 'admin/libs/alertifyjs/build', 'filename' => 'alertify.min.js']) }}">
    </script>

    <!-- Sweet Alerts js -->
    <script src="{{ route('assetFile', ['folder' => 'user/libs/sweetalert2', 'filename' => 'sweetalert2.min.js']) }}">
    </script>

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

    <script>
        function submitEdit() {
            // Input değerlerini al
            const fields = {
                name: document.getElementById('name').value,
                username: document.getElementById('username').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                repeat_password: document.getElementById('repeat_password').value,
            };

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Boş alanları bul
            const emptyFields = Object.entries(fields)
                .filter(([key, value]) => value.trim() === "")
                .map(([key]) => {
                    switch (key) {
                        case "name":
                            return "{{ lang_db('Name', 2) }}";
                        case "username":
                            return "{{ lang_db('Username', 2) }}";
                        case "email":
                            return "{{ lang_db('E-Mail', 2) }}";
                        case "password":
                            return "{{ lang_db('Password', 2) }}";
                        case "repeat_password":
                            return "{{ lang_db('Repeat password', 2) }}";

                    }
                });


            // Eğer boş alan varsa kullanıcıya göster
            if (emptyFields.length > 0) {
                Swal.fire({
                    type: "error",
                    title: "{{ lang_db('Error!', 2) }}",
                    text: `{{ lang_db('Please fill in the required fields', 2) }}. {{ lang_db('Empty fields', 2) }}: ${emptyFields.join(", ")}`,
                    background: '#fff'
                });
                return;
            }

            // E-posta doğrulama ve şifre eşleşme kontrolü
            if (!emailPattern.test(fields.email)) {
                Swal.fire({
                    type: "error",
                    title: "{{ lang_db('Error!', 2) }}",
                    text: "{{ lang_db('Please enter a valid email address', 2) }}",
                    background: '#fff'
                });
                return;
            }

            //Şifre kontrolü
            if (fields.password !== fields.repeat_password) {
                Swal.fire({
                    type: "error",
                    title: "{{ lang_db('Error!', 2) }}",
                    text: "{{ lang_db('Password and Repeat Password do not match', 2) }}",
                    background: '#fff'
                });
                return;
            }

            // Formu gönder
            document.getElementById('registerFormID').submit();
        }
    </script>

</body>

</html>
