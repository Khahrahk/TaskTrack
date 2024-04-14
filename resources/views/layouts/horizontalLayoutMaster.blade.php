<body class="horizontal-layout horizontal-menu"
      data-open="hover"
      data-menu="horizontal-menu"
      data-col=""
      data-framework="laravel"
      data-asset-path="{{ asset('/')}}">

@include('panels.navbar')
<div class="app-content content" style="height: 100%;">
    <div class="content-area-wrapper h-100" style="height: 100%;">
        <div class="d-flex flex-column" style="height: 100%;">
            <div class="d-flex flex-row" style="height: 100%;">
                <div class="d-flex flex-column" style="height: 100%;">
                    <div class="d-flex flex-row" style="height: 100%;">
                        @include('panels.sidebar')
                    </div>
                </div>
                <div class="d-flex flex-column w-100">
                    <div class="d-flex flex-row w-100">
                        @yield('header')
                    </div>
                    <div class="d-flex flex-row" style="height: 100%">
                        <div class="content-wrapper w-100">
                            <div class="content-body">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- include footer --}}
@include('panels/footer')

{{-- include default scripts --}}
@include('panels/scripts')
</body>

</html>
