<nav class="navbar navbar-expand navbar-dark bg-dark d-flex flex-row w-100 ps-3 pb-0 pt-1" style="margin: 0; box-shadow: none; border-bottom:  1px solid rgba(0, 0, 0, 0.1)">
    <div class="container-fluid">
        <a class="navbar-brand  " href="{{route('dashboard')}}">TaskTrack</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="d-flex w-100 justify-content-end collapse navbar-collapse" id="navbarNavDarkDropdown">
            <ul class="navbar-nav">
                <li class="d-flex nav-item dropdown pe-4">
                    <button class="btn btn-dark" data-bs-toggle="dropdown" aria-expanded="false">
                        {{auth()->user()->name}}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark me-4 mt-2" style="right: 0; left: auto;">
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                        <li><a class="dropdown-item" href="{{route('workspaces')}}">Workspaces</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
