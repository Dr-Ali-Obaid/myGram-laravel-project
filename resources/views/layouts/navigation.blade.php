@php
use Illuminate\Support\Str;
@endphp

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-7 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <div class="hidden sm:flex sm:items-center">
                    @livewire('search')
                </div>

                <!-- Navigation Links -->
               
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @guest
                    <div class="hidden md:flex md:items-center md:space-x-2">
                        <div class="space-x-3 text-[i.6rem] ltr:mr-5 rtl:ml-5 loading-5">
                            <a href="/login"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-trnsparent rounded-md font-semibold text-xs text-white uppercase tracking-widest ltr:mr-2 rtl:ml-2">{{__("Login")}}</a>
                            <a href="/register"
                            class="inline-flex items-center px-4 py-2 font-semibold text-xs uppercase tracking-widest">{{__("Register")}}</a>
                        </div>
                    </div>
                @endguest
                @auth
                    <div class="flex items-center space-x-3">
                        <div class="space-x-3 text-[1.6rem] ltr:mr-2 rtl:ml-2 leading-5">
                            <a href="{{route('home')}}" class="ltr:mr-3 rtl:ml-3">
                                {!! url()->current() == route("home")
                                ? '<i class="bx bxs-home-alt-2"></i>'
                                : '<i class="bx bx-home-alt-2" ></i>' !!}
                            </a>
                            <a href="{{route('explore')}}">
                                {!! url()->current() == route("explore")
                                ? '<i class="bx bxs-compass"></i>'
                                : '<i class="bx bx-compass" ></i>' !!}
                            </a>
                            <button onclick="Livewire.dispatch('openModal', { component: 'create-post-modal'})">
                                <i class="bx bx-message-square-add"></i>
                            </button>
                            
                            
                               
                        </div>
                        <x-dropdown align="right" width="96">
                            <x-slot name="trigger">
                                <button class="text-[1.6rem] ltr:mr-2 rtl:ml-2 leading-5">
                                    <div class="relative">
                                        <i class="bx bxs-inbox py-2 me-4"></i>
                                        @livewire('pending-follower-count')
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @livewire('pending-followers-list')
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth
                <div class="hidden md:block">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @auth
                        <div class="ltr:ml-3 rtl:mr-3">
                            <img src="{{Str::startsWith(auth()->user()->image, 'http') ? auth()->user()->image : asset("storage/" . auth()->user()->image)}}" class="w-6 h-6 rounded-full" alt="">
                        </div>
                        @endauth
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                </div>
            </div>
            
            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @guest
            <x-responsive-nav-link :href="route('login')">
                {{ __('Login') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('register')">
                {{ __('Register') }}
            </x-responsive-nav-link>
            @endguest
            @auth
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>
            @endauth
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('explore')">
                    {{ __('Explore') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link class="cursor-pointer" onclick="Livewire.dispatch('openModal', { component: 'create-post-modal'})">
                    {{ __('New Post') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
