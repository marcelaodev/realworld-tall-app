<div>
    <ul class="nav navbar-nav flex-row">
        <li class="nav-item {{ $currentRouteName == 'front.index' ? 'active' : '' }}">
            <a class="nav-link" wire:navigate href="{{ route('front.index') }}">
                Home
            </a>
        </li>

        @auth
            <li class="nav-item  {{ $currentRouteName == 'app.article.create' ? 'active' : '' }}">
                <a class="nav-link" wire:navigate href="{{ route('app.article.create') }}">
                    <i class="ion-compose"></i>&nbsp;New Post
                </a>
            </li>
            <li class="nav-item  {{ $currentRouteName == 'front.user.show' ? 'active' : '' }}">
                <a class="nav-link" wire:navigate
                    href="{{ route('front.user.show', ['user' => auth()->user()?->username ?? 1]) }}">
                    <i class="ion-person"></i>&nbsp;Profile
                </a>
            </li>
            <li class="nav-item  {{ $currentRouteName == 'app.setting' ? 'active' : '' }}">
                <a class="nav-link" wire:navigate href="{{ route('app.setting') }}">
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
            <li class="nav-item  {{ $currentRouteName == 'app.login' ? 'active' : '' }}">
                <a class="nav-link" wire:navigate href="{{ route('app.login') }}">
                    Sign In
                </a>
            </li>
            <li class="nav-item  {{ $currentRouteName == 'app.register' ? 'active' : '' }}">
                <a class="nav-link" wire:navigate href="{{ route('app.register') }}">
                    Sign Up
                </a>
            </li>
        @endguest
    </ul>
</div>