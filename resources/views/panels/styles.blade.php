@yield('vendor-style')
<link rel="stylesheet" href="{{ asset(mix('css/core.css')) }}"/>
<style>
    @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";

    body {
        font-family: 'Poppins', sans-serif;
        background: #fafafa
    }

    p {
        font-size: 1.1em;
        font-weight: 300;
        line-height: 1.7em;
        color: #999
    }

    a, a:hover, a:focus {
        color: inherit;
        text-decoration: none;
        transition: all 0.3s
    }

    .navbar {
        padding: 15px 10px;
        background: #fff;
        border: none;
        border-radius: 0;
        margin-bottom: 40px;
        box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1)
    }

    .navbar-btn {
        box-shadow: none;
        outline: none !important;
        border: none
    }

    .line {
        width: 100%;
        height: 1px;
        border-bottom: 1px dashed #ddd
    }

    .wrapper {
        display: flex;
        width: 100%;
        align-items: stretch
    }

    #sidebar {
        transition: all 0.6s
    }

    #sidebar.active {
        margin-left: -250px
    }

    a[data-toggle="collapse"] {
        position: relative
    }

    .dropdown-toggle::after {
        display: block;
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%)
    }

    ul ul a {
        font-size: 0.9em !important;
        padding-left: 30px !important;
        background: #318fb5
    }

    ul.CTAs {
        padding: 20px
    }

    ul.CTAs a {
        text-align: center;
        font-size: 0.9em !important;
        display: block;
        border-radius: 5px;
        margin-bottom: 5px
    }

    a.download, a.download:hover {
        background: #318fb5;
        color: #fff
    }

    #content {
        width: 100%;
        padding: 20px;
        min-height: 100vh;
        transition: all 0.3s
    }

    .content-wrapper {
        padding: 15px
    }

    @media (max-width: 768px) {
        #sidebar {
            margin-left: -250px
        }

        #sidebar.active {
            margin-left: 0px
        }

        #sidebarCollapse span {
            display: none
        }
    }
</style>
@yield('page-style')
<link rel="stylesheet" href="{{ asset(mix('css/overrides.css')) }}"/>
