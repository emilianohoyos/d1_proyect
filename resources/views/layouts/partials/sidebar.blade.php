<!-- BEGIN sidebar -->
<div class="sidebar">
    <!-- BEGIN sidebar-user -->
    <div class="sidebar-user">
        <div class="sidebar-user-img">
            <img src="{{ asset('assets/img/user/user-13.jpg') }}" alt="">
        </div>
        <div class="sidebar-user-info">
            <div class="sidebar-user-name">{{ Auth::user()->name ?? 'Guest' }}</div>
            <div class="sidebar-user-role">{{ Auth::user()->email ?? 'Not logged in' }}</div>
        </div>
    </div>
    <!-- END sidebar-user -->

    <!-- BEGIN sidebar-nav -->
    <ul class="sidebar-nav">
        <li class="sidebar-nav-item">
            <a href="{{ url('/') }}" class="sidebar-nav-link {{ request()->is('/') ? 'active' : '' }}">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="{{ route('profile') }}" class="sidebar-nav-link {{ request()->is('profile*') ? 'active' : '' }}">
                <i class="fa fa-user"></i>
                <span>Profile</span>
            </a>
        </li>
        <li class="sidebar-nav-item">
            <a href="{{ route('settings') }}" class="sidebar-nav-link {{ request()->is('settings*') ? 'active' : '' }}">
                <i class="fa fa-cog"></i>
                <span>Settings</span>
            </a>
        </li>
        @auth
            <li class="sidebar-nav-item">
                <a href="{{ route('logout') }}" class="sidebar-nav-link"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out-alt"></i>
                    <span>{{ __('Logout') }}</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        @else
            <li class="sidebar-nav-item">
                <a href="{{ route('login') }}" class="sidebar-nav-link {{ request()->is('login*') ? 'active' : '' }}">
                    <i class="fa fa-sign-in-alt"></i>
                    <span>{{ __('Login') }}</span>
                </a>
            </li>
            @if (Route::has('register'))
                <li class="sidebar-nav-item">
                    <a href="{{ route('register') }}"
                        class="sidebar-nav-link {{ request()->is('register*') ? 'active' : '' }}">
                        <i class="fa fa-user-plus"></i>
                        <span>{{ __('Register') }}</span>
                    </a>
                </li>
            @endif
        @endauth
    </ul>
    <!-- END sidebar-nav -->
</div>
<!-- END sidebar -->
