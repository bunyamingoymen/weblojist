@php
    $admin_logo = getCachedKeyValue(['key' => 'logos', 'value' => 'Admin Logo', 'first' => true]) ?? null;
    $admin_logo_small_light =
        getCachedKeyValue(['key' => 'logos', 'value' => 'Admin Logo Small Light', 'first' => true]) ?? null;
    $admin_logo_small_dark =
        getCachedKeyValue(['key' => 'logos', 'value' => 'Admin Logo Small Dark', 'first' => true]) ?? null;
@endphp

<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">

            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ isset($admin_logo_small_light) ? asset($admin_logo_small_light->optional_5) : '' }}"
                            alt="" height="42">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ isset($admin_logo) ? asset($admin_logo->optional_5) : '' }}" alt=""
                            height="40">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="mdi mdi-backburger"></i>
            </button>

            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="mdi mdi-magnify"></span>
                </div>
            </form>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ml-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if (isset($main_flag) && isset($other_flags) && $main_flag != '-1')
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-flag-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="" src="{{ asset($main_flag) }}" alt="Header Language" height="14">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach ($other_flags as $flag)
                            <a href="{{ route('Translation.setActiveLang', ['locale' => $flag->optional_1]) }}"
                                class="dropdown-item notify-item">
                                <img src="{{ asset($flag->optional_5) }}" alt="user-image" class="mr-2"
                                    height="12"><span class="align-middle">{{ $flag->value }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif


            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen"></i>
                </button>
            </div>

            <!--
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="mdi mdi-bell-outline"></i>
                    <span class="badge badge-danger badge-pill">3</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0 font-weight-medium text-uppercase"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                <span class="badge badge-pill badge-danger">New 3</span>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                        <i class="mdi mdi-cart"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">Your order is placed</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">If several languages coalesce the grammar</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <img src="{{ route('assetFile', ['folder' => 'admin/images/users', 'filename' => 'avatar-3.jpg']) }}"
                                    class="mr-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">Andrew Mackie</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">It will seem like simplified English.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <div class="avatar-xs mr-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="mdi mdi-package-variant-closed"></i>
                                    </span>
                                </div>
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">Your item is shipped</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">One could refuse to pay expensive translators.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="" class="text-reset notification-item">
                            <div class="media">
                                <img src="{{ route('assetFile', ['folder' => 'admin/images/users', 'filename' => 'avatar-4.jpg']) }}"
                                    class="mr-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="media-body">
                                    <h6 class="mt-0 mb-1">Dominic Kellway</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">As a skeptical Cambridge friend of mine occidental.
                                        </p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top">
                        <a class="btn-link btn btn-block text-center" href="javascript:void(0)">
                            <i class="mdi mdi-arrow-down-circle mr-1"></i> Load More..
                        </a>
                    </div>
                </div>
            </div>
            -->
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="{{ asset(Auth::guard('admin')->user()->image ?? 'defaultFiles/user/default_user.webp') }}"
                        alt="Header Avatar">
                    <span
                        class="d-none d-sm-inline-block ml-1">{{ Auth::guard('admin')->user()->name ?? env('APP_NAME') }}</span>
                    <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                            class="mdi mdi-face-profile font-size-16 align-middle mr-1"></i>
                        {{ lang_db('Profile') }}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('admin_page', ['params' => 'logout']) }}"><i
                            class="mdi mdi-logout font-size-16 align-middle mr-1"></i> {{ lang_db('Logout') }}</a>
                </div>
            </div>

        </div>
    </div>
</header>
