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

    <title>{{ env('APP_NAME') }} | {{ lang_db($title) }} | Admin Panel</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ !is_null($icon) ? asset($icon->optional_5) : '' }}">

    <!-- Bootstrap Css -->
    <link href="{{ route('assetFile', ['folder' => 'admin/css', 'filename' => 'bootstrap.min.css']) }}" rel="stylesheet"
        type="text/css" />

    <!-- Icons Css -->
    <link href="{{ route('assetFile', ['folder' => 'admin/css', 'filename' => 'icons.min.css']) }}" rel="stylesheet"
        type="text/css" />

    <!-- alertifyjs Css -->
    <link
        href="{{ route('assetFile', ['folder' => 'admin/libs/alertifyjs/build/css', 'filename' => 'alertify.min.css']) }}"
        rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="{{ route('assetFile', ['folder' => 'admin/libs/sweetalert2', 'filename' => 'sweetalert2.min.css']) }}"
        rel="stylesheet" type="text/css" />


    <!-- App Css-->
    <link href="{{ route('assetFile', ['folder' => 'admin/css', 'filename' => 'app.min.css']) }}" rel="stylesheet"
        type="text/css" />

    <!--Ag grid-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.3/styles/ag-grid.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.3/styles/ag-theme-quartz.css" />

    <script src="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.3/dist/ag-grid-community.min.js"></script>

</head>

<body data-sidebar="dark">

    <!-- Begin page -->
    <div id="layout-wrapper">

        @include('admin.layouts.header')

        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.layouts.sidebar')
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">{{ lang_db($title) }}</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div>
                        @yield('admin_index_body')
                    </div>
                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->


            @include('admin.layouts.footer')
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <div id="hiddenDiv" hidden>

    </div>

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

    <!--tinymce js-->
    <script src="{{ route('assetFile', ['folder' => 'admin/libs/tinymce', 'filename' => 'tinymce.min.js']) }}"></script>

    <!-- alertifyjs js -->
    <script src="{{ route('assetFile', ['folder' => 'admin/libs/alertifyjs/build', 'filename' => 'alertify.min.js']) }}">
    </script>


    <!-- Sweet Alerts js -->
    <script src="{{ route('assetFile', ['folder' => 'admin/libs/sweetalert2', 'filename' => 'sweetalert2.min.js']) }}">
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

    <!--Form Ayarları-->
    <script>
        var tiny_lang = "{{ getActiveLang() }}";
    </script>

    <!-- init js -->
    <script src="{{ route('assetFile', ['folder' => 'admin/js/pages', 'filename' => 'form-editor.init.js']) }}"></script>


</body>

</html>
