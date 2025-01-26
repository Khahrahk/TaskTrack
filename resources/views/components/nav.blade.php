<div class="d-flex flex-column w-100">
    <nav class="d-flex flex-row navbar navbar-page navbar-expand-lg bg-white w-100 ps-3 pb-1"
         style="margin: 0; box-shadow: none; border-bottom:  1px solid rgba(0, 0, 0, 0.1); height: 45px">
        <x-button class="toggle-right close" size="sm" monochrome outline
                  iconRight="burger-menu-svgrepo-com"></x-button>

        <div class="container-fluid">

        </div>
    </nav>
    <nav class="d-flex flex-row bg-white w-100 ps-3 p-2 submenu" style="margin: 0; box-shadow: none; border-bottom:  1px solid rgba(0, 0, 0, 0.1); height: 45px">
        @isset($pageSubmenu)
            <div class="d-flex flex-row actions gap-1">
                @foreach($pageSubmenu as $page)
                    <a class="d-flex flex-column px-4 p-1 {{Request::routeIs($page['link']) ? 'active' : ''}}" href="{{ route($page['link']) }}">
                        <div>
                            {{$page['name']}}
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="container-fluid">

            </div>
        @endif
    </nav>
</div>
