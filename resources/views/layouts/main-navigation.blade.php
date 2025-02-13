<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 dark:bg-gray-900 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-full px-4 mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between h-24">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block w-auto h-10 text-green-600 fill-current dark:text-green-400" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-green-600 hover:text-green-800 text-base font-medium">
        {{ __('Beranda') }}
    </x-nav-link>
    <x-nav-link :href="route('about')" :active="request()->routeIs('about')" class="text-green-600 hover:text-green-800 text-base font-medium">
        {{ __('Profil') }}
    </x-nav-link>
    <x-nav-link :href="route('program')" :active="request()->routeIs('program')" class="text-green-600 hover:text-green-800 text-base font-medium">
        {{ __('Program') }}
    </x-nav-link>
    <div class="items-center hidden sm:flex">
        <x-dropdown align="left" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center py-2 text-green-600 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-green-800 text-base font-medium">
                    <div>{{ __('Menu Lain') }}</div>
                    <div class="ms-1">
                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('sejarah')" class="text-green-600 hover:text-green-800 text-base font-medium">
                    {{ __('Sejarah') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('visimisi')" class="text-green-600 hover:text-green-800 text-base font-medium">
                    {{ __('Visi Misi') }}
                </x-dropdown-link>
            </x-slot>
        </x-dropdown>
    </div>
</div>

            </div>

            <!-- Login, Donasi, dan Auth -->
<div class="hidden sm:flex items-center space-x-4">
    <!-- Tombol Donasi -->
    <a href="{{ route('program') }}" class="px-6 py-2 text-lg font-semibold text-white bg-green-600 rounded-lg shadow-md hover:bg-green-700 transition">
        {{ __('Donasi') }}
    </a>

    @auth
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 text-green-600 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-green-800 focus:outline-none">
                    <div>{{ Auth::user()->name }}</div>
                    <div class="ms-1">
                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('dashboard')" class="text-green-600 hover:text-green-800">
                    {{ __('Dasbor') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('profile.edit')" class="text-green-600 hover:text-green-800">
                    {{ __('Profil') }}
                </x-dropdown-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();" class="text-green-600 hover:text-green-800">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    @else
        <!-- Tombol Masuk -->
        <x-nav-link :href="route('login')" :active="request()->routeIs('login')" class="text-green-600 hover:text-green-800">
            {{ __('Masuk') }}
        </x-nav-link>
    @endauth
</div>


            <!-- Mobile Menu -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-green-600 transition duration-150 ease-in-out rounded-md hover:text-green-800 focus:outline-none">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
