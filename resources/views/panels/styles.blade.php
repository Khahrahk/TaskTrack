@yield('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('css/core.css')) }}"/>
<style>
    .menu-bar .active {
        background-color: rgba( 222, 223, 224, 0.7 );
        border-radius: 5px;
    }

    .submenu a {
        color: black;
        text-decoration: none;
    }

    .submenu a:not(.active):hover {
        background-color: rgba( 222, 223, 224, 0.3 );
        border-radius: 5px;
    }

    .submenu .active {
        background-color: rgba( 222, 223, 224, 0.7 );
        border-radius: 5px;
    }

    .active .nav-text {
        font-weight: 550 !important;
    }

    .sidebar-element:not(.active):hover {
        background-color: rgba( 222, 223, 224, 0.3 );
        border-radius: 5px;
    }
</style>
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
@yield('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/overrides.css')) }}"/>
