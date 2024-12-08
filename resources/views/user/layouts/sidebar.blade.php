<div class="vertical-menu">

    <div data-simplebar class="h-100">
        
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('user.user') }}" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>{{ lang_db('Dashboard', 2) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.product') }}" class="waves-effect">
                        <i class="mdi mdi-cube-outline"></i>
                        <span>{{ lang_db('Products', 2) }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.cart') }}" class="waves-effect">
                        <i class="mdi mdi-cart"></i>
                        <span>
                            @if (isset($cart_count) && $cart_count > 0)
                                <span class="badge badge-pill badge-success float-right">{{ $cart_count }}</span>
                            @endif

                            {{ lang_db('Card', 2) }}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.order') }}" class="waves-effect">
                        <i class="mdi mdi-shopping"></i>
                        <span>{{ lang_db('Orders', 2) }}</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</div>
