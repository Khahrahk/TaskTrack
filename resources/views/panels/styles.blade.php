@yield('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('css/core.css')) }}"/>

@yield('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/overrides.css')) }}"/>
