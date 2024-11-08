<div>
    <ul class="nav navbar-nav flex-row">
        <li class="nav-item {{ $currentRouteName == 'home' ? 'active' : '' }}">
            <a class="nav-link" wire:navigate href="{{ route('home') }}">
                Home
            </a>
        </li>

        @auth
            <li class="nav-item  {{ $currentRouteName == 'article.create' ? 'active' : '' }}">
                <a class="nav-link" wire:navigate href="{{ route('article.create') }}">
                    <i class="ion-compose"></i>&nbsp;New Post
                </a>
            </li>
            <li
                class="nav-item  {{ $currentRouteName == 'user.show' && $currentRouteUsername === auth()->user()->username ? 'active' : '' }}">
                <a class="nav-link" wire:navigate
                    href="{{ route('user.show', ['user' => auth()->user()?->username ?? 1]) }}">
                    <i class="ion-person"></i>&nbsp;Profile
                </a>
            </li>
            <li class="nav-item  {{ $currentRouteName == 'user.setting' ? 'active' : '' }}">
                <a class="nav-link" wire:navigate href="{{ route('user.setting') }}">
                    <i class="ion-gear-a"></i>&nbsp;Settings
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" wire:click="$dispatchTo('menu', 'logout')">
                    <i class="ion-gear-a"></i>&nbsp;Logout
                </a>
            </li>
        @endauth
        @guest
            <li class="nav-item  {{ $currentRouteName == 'login' ? 'active' : '' }}">
                <a class="nav-link" wire:navigate href="{{ route('login') }}">
                    Sign In
                </a>
            </li>
            <li class="nav-item  {{ $currentRouteName == 'register' ? 'active' : '' }}">
                <a class="nav-link" wire:navigate href="{{ route('register') }}">
                    Sign Up
                </a>
            </li>
        @endguest
    </ul>
</div>