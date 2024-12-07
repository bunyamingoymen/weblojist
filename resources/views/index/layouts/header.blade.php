@php
    $home_logo_white = getCachedKeyValue(['key' => 'logos', 'value' => 'Home Logo White', 'first' => true]) ?? null;
    $home_logo_dark = getCachedKeyValue(['key' => 'logos', 'value' => 'Home Logo Dark', 'first' => true]) ?? null;

    $headers = App\Models\Main\Menu::where('delete', 0)->where('active', 1)->where('type', 'header')->get();
    if (Route::currentRouteName() == '') {
        $use_theme = 'dark';
    } else {
        $use_theme_db = getCachedKeyValue(['key' => 'header_theme', 'first' => true, 'refreshCache' => true]) ?? null;
        $use_theme = $use_theme_db ? $use_theme_db->value : 'dark';
    }

@endphp
<nav
    class="navbar navbar-default navbar-fixed navbar-transparent {{ $use_theme == 'dark' ? 'dark' : 'white' }} bootsnav on no-full">
    <!--== End Top Search ==-->
    <div class="container">

        <!--== Start Header Navigation ==-->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"> <i
                    class="tr-icon ion-android-menu"></i> </button>
            <div class="logo"> <a href="{{ route('index.index') }}"> <img
                        class="logo {{ $use_theme == 'white' ? 'logo-display' : 'logo-scrolled' }}"
                        src="{{ !is_null($home_logo_white) && $home_logo_white->optional_5 ? asset($home_logo_white->optional_5) : '' }}"
                        alt=""> <img class="logo {{ $use_theme == 'dark' ? 'logo-display' : 'logo-scrolled' }}"
                        src="{{ !is_null($home_logo_dark) && $home_logo_dark->optional_5 ? asset($home_logo_dark->optional_5) : '' }}"
                        alt=""> </a> </div>
        </div>
        <!--== End Header Navigation ==-->

        <!--== Collect the nav links, forms, and other content for toggling ==-->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="nav navbar-nav navbar-center" data-in="fadeIn" data-out="fadeOut">
                <li><a href="{{ route('index.index') }}">{{ lang_db('Home', 1) }}</a></li>ü
                @foreach ($headers->where('top_category', '0') as $header)
                    @if (count($headers->where('top_category', $header->code)) > 0)
                        <li class="dropdown">
                            <a href="{{ url($header->path) }}" class="dropdown-toggle" data-toggle="dropdown"
                                {{ $header->open_different_page ? 'target="_blank"' : '' }}>
                                {{ lang_db($header->title, -1) }}
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($headers->where('top_category', $header->code) as $header_alt)
                                    <li>
                                        <a href="{{ url($header_alt->path) }}"
                                            {{ $header_alt->open_different_page ? 'target="_blank"' : '' }}>
                                            {{ lang_db($header_alt->title, -1) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li>
                            <a href="{{ url($header->path) }}"
                                {{ $header->open_different_page ? 'target="_blank"' : '' }}>
                                {{ lang_db($header->title, -1) }}
                            </a>
                        </li>
                    @endif
                @endforeach
                <li><a href="{{ route('user.login') }}" class="">Giriş Yap</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

            </ul>
        </div>
        <!--== /.navbar-collapse ==-->
    </div>

</nav>
