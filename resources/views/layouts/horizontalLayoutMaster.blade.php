<body class="horizontal-layout horizontal-menu"
data-open="hover"
data-menu="horizontal-menu"
data-col=""
data-framework="laravel"
data-asset-path="{{ asset('/')}}">

  <!-- BEGIN: Header-->
  @include('panels.navbar')

  <!-- BEGIN: Content-->
  <div class="app-content content">
    <div class="content-area-wrapper">
      <div>
        <div class="content-wrapper">
          <div class="content-body">
            {{-- Include Page Content --}}
            @yield('content')
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
