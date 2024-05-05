<body class="horizontal-layout horizontal-menu"
      data-open="hover"
      data-menu="horizontal-menu"
      data-col=""
      data-framework="laravel"
      data-asset-path="{{ asset('/')}}">

<div class="d-flex flex-column app-content content h-100">
    @include('panels.navbar')
    <div class="d-flex flex-row content-area-wrapper h-100">
        <div class="d-flex flex-column">
            <div class="d-flex flex-row h-100">
                @include('panels.sidebar')
            </div>
        </div>
        <div class="d-flex flex-column w-100">
            <div class="d-flex flex-row w-100">
                @yield('header')
            </div>
            <div class="d-flex flex-row content-area-wrapper h-100">
                <div class="d-flex flex-column w-100">
                    <div class="d-flex flex-row h-100">
                        @yield('content')
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
