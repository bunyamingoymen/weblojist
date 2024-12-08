<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <div id="sidebar-menu">

            <ul class="metismenu list-unstyled" id="side-menu">
                @foreach ($sidebarHTML as $item)
                    {!! $item !!}
                @endforeach
            </ul>

        </div>
        
    </div>
</div>
