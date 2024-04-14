<nav class="navbar navbar-expand-lg bg-light d-flex flex-row w-100 ps-3 pb-1" style="margin: 0; box-shadow: none; border-bottom:  1px solid rgba(0, 0, 0, 0.1)">
    <button type="button" id="sidebarCollapse" class="btn btn-info"><i class="fa fa-align-justify"></i></button>

    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('dashboard')}}">TaskTrack</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown"><ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('dashboard')}}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('workspaces')}}">Workspaces</a>
                </li>
                @if(!auth()->user()->userWorkspace->isEmpty())
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('projects')}}">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('issues')}}">Issues</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('agiles')}}">Agile boards</a>
                    </li>
                @endif

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{auth()->user()->name}}
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
