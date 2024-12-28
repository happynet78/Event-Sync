<div class="navbar bg-base-100">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
            </div>
            <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                <li><a>Homepage</a></li>
                <li><a>Portfolio</a></li>
                <li><a>About</a></li>
            </ul>
        </div>
    </div>
    <div class="navbar-center">
        <a href="{{ route('home') }}" class="p-2" wire:navigate>
            {{ config('app.name') }}
        </a>
    </div>
    <div class="navbar-end space-x-2">
        @guest
            <a href="{{ route('login') }}" wire:navigate class="btn btn-primary">
                Login
            </a>

            <a href="{{ route('register') }}" wire:navigate class="btn btn-secondary">
                Register
            </a>
        @endguest
        @auth
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img
                            alt="{{ auth()->user()->name }} profile picture"
                            src="{{ auth()->user()->profile_photo_url }}"/>
                    </div>
                    <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                        <li>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <a href="{{ route('logout') }}"
                                   @click.prevent="$root.submit()">
                                    Logout
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        @endauth
    </div>
</div>
