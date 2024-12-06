<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                @foreach ($sidebarHTML as $item)
                    {!! $item !!}
                @endforeach
            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
