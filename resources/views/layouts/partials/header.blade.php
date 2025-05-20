<!-- BEGIN navbar-header -->
<div class="navbar-header">
    <a href="{{ url('/') }}" class="navbar-brand">
        <span class="navbar-logo"></span>
        <b>Color</b> Admin
    </a>
    <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
</div>
<!-- END navbar-header -->

<!-- BEGIN header-nav -->
<ul class="navbar-nav navbar-right">
    <li class="nav-item">
        <a href="#" class="nav-link" data-toggle="navbar-search">
            <i class="fa fa-search"></i>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link" data-toggle="dropdown">
            <i class="fa fa-bell"></i>
            <span class="badge">5</span>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <div class="dropdown-header">Notifications</div>
            <div class="dropdown-body">
                <div class="dropdown-item">
                    <div class="d-flex align-items-center">
                        <div class="flex-fill">
                            <div class="font-weight-600">New order received</div>
                            <div class="small text-muted">3 minutes ago</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown-footer">
                <a href="#">View All</a>
            </div>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link" data-toggle="dropdown">
            <i class="fa fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            <div class="dropdown-header">User</div>
            <div class="dropdown-body">
                @auth
                    <div class="dropdown-item">
                        <div class="d-flex align-items-center">
                            <div class="flex-fill">
                                <div class="font-weight-600">{{ Auth::user()->name }}</div>
                                <div class="small text-muted">{{ Auth::user()->email }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="dropdown-item">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="dropdown-item">{{ __('Register') }}</a>
                    @endif
                @endauth
            </div>
        </div>
    </li>
</ul>
<!-- END header-nav -->
