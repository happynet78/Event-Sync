<div class="navbar bg-base-100">
    <div class="navbar-start">
        <div aria-label="Mobile Menu Button" tabindex="0" wire:click="toggleDrawer" role="button" class="lg:hidden btn btn-ghost btn-circle">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </div>
        <a href="{{ route('home') }}" wire:navigate>
            {{ config('app.name') }}
        </a>

        <!-- <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                <li><a href="{{ route('home') }}">Homepage</a></li>
                <li><a>Portfolio</a></li>
                <li><a>About</a></li>
            </ul>
        </div> -->
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            @foreach ($menu->menuItems as $item)
                <li>
                    <a href="{{ $item->url }}" wire:navigate>
                        @if ($item->icon)
                            <x-mary-icon name="{{ $item->icon }}" />
                        @endif
                        {{ $item->title }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="navbar-end space-x-2">
        @php($languages = ['en' => 'English', 'ko' => '한국어'])
        <select class="select select-warning w-24 max-w-xs" wire:model.live="lang" aria-label="Language">
            <option value="en">English</option>
            <option value="ko">한국어</option>
        </select>
        <div class="form-control me-2">
            <input type="text" placeholder="Search" class="input input-bordered w-24 md:w-auto" />
        </div>
        <div class="dropdown dropdown-end">
        @guest
            <a href="{{ route('login') }}" wire:navigate class="btn btn-primary">
                Login
            </a>

            <a href="{{ route('register') }}" wire:navigate class="btn btn-secondary">
                Register
            </a>
        @endguest
        @auth
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img
                        alt="{{ auth()->user()->name }} profile picture"
                        src="{{ auth()->user()->profile_photo_url }}"/>
                </div>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                @foreach ($dropdown->menuItems as $item)
                    <li>
                        <a href="{{ $item->url }}" {{ $item->use_navigate ? 'wire:navigate' : '' }}>
                            {{ $item->title }}
                        </a>
                    </li>
                @endforeach
                <li>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a href="{{ route('logout') }}" @click.prevent="$root.submit()">
                            Logout
                        </a>
                    </form>
                </li>
            </ul>
        @endauth
        </div>
    </div>

    <x-mary-drawer wire:model="responsiveMenu" class="w-11/12 lg:w-1/3">
        <x-mary-menu class="p-0 m-0">
            @foreach ($menu->menuItems as $item)
                <x-mary-menu-item title="{{ $item->title }}" link="{{ $item->url }}" icon="{{ $item->icon }}" />
            @endforeach
        </x-mary-menu>
    </x-mary-drawer>
</div>
