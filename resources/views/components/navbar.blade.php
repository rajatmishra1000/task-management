<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-warning" href="{{ route('home') }}">Task Manager</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if( url()->current() === route('projects.index')) active @endif" 
                        href="{{ route('projects.index') }}">
                        Projects
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if( url()->current() === route('tasks.index')) active @endif"
                        href="{{ route('tasks.index') }}">
                        Tasks
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
