@php
    use Lucide\Icons\LogIn;
    use Lucide\Icons\UserPlus;
@endphp

<nav class="bg-white sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-0">
        <div class="flex justify-between items-center h-16">

            <!-- Left side -->
            <div class="flex items-center lg:space-x-8">
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ url('images/logo.png') }}" alt="Logo" class="h-10 w-10 object-contain" />
                    <span class="md:hidden lg:flex text-sm lg:text-xl font-bold text-gray-900">{{ config('app.name') }}</span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-baseline space-x-4 lg:space-x-4">
                    <a href="{{ url('/') }}"
                        class="px-2 lg:px-3 py-2 rounded-md text-sm font-medium transition-colors 
                       {{ request()->is('/') ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }}">
                        {{ __('app/menu.home') }}
                    </a>
                    <a href="{{ url('/about') }}"
                        class="px-2 lg:px-3 py-2 rounded-md text-sm font-medium transition-colors 
                       {{ request()->is('about') ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }}">
                        {{ __('app/menu.about') }}
                    </a>
                    <a href="{{ url('/reports') }}"
                        class="px-2 lg:px-3 py-2 rounded-md text-sm font-medium transition-colors 
                       {{ request()->is('reports*') ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }}">
                        {{ __('app/menu.reports') }}
                    </a>
                    <a href="{{ url('/contact') }}"
                        class="px-2 lg:px-3 py-2 rounded-md text-sm font-medium transition-colors 
                       {{ request()->is('contact') ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }}">
                        {{ __('app/menu.contact') }}
                    </a>
                </div>
            </div>

            <!-- Right side -->
            <div class="hidden md:flex items-center space-x-2 lg:space-x-4">
                @guest
                    <!-- Not Authenticated -->
                    <a href="{{ route('login') }}"
                        class="btn-secondary flex items-center gap-2 text-sm px-4 py-2 hover:bg-primary-50">
                        <x-lucide-log-in class="w-4 h-4" />
                        <span>{{ __('app/menu.login') }}</span>
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary flex items-center gap-2 text-sm px-4 py-2">
                        <x-lucide-user-plus class="w-4 h-4" />
                        <span>{{ __('app/menu.register') }}</span>
                    </a>
                @else
                    <!-- Settings Dropdown -->
                    @include('components.settings-dropdown')
                    
                    <!-- Profile Dropdown -->
                    @include('components.profile-dropdown')

                @endguest
            </div>

            <!-- Mobile toggle -->
            <div class="md:hidden">
                <button id="mobile-menu-toggle"
                    class="bg-gray-100 inline-flex items-center justify-center p-2 rounded-md text-gray-700 focus:outline-none">
                    <svg id="menu-open-icon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg id="menu-close-icon" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
            <a href="{{ url('/') }}"
                class="block px-3 py-2 rounded-md text-base font-medium transition-colors
               {{ request()->is('/') ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }}">
                {{ __('app/menu.home') }}
            </a>
            <a href="{{ url('/about') }}"
                class="block px-3 py-2 rounded-md text-base font-medium transition-colors
               {{ request()->is('about') ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }}">
                {{ __('app/menu.about') }}
            </a>
            <a href="{{ url('/reports') }}"
                class="block px-3 py-2 rounded-md text-base font-medium transition-colors
               {{ request()->is('reports*') ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }}">
                {{ __('app/menu.reports') }}
            </a>
            <a href="{{ url('/contact') }}"
                class="block px-3 py-2 rounded-md text-base font-medium transition-colors
               {{ request()->is('contact') ? 'text-primary-600 font-semibold' : 'text-gray-700 hover:text-primary-600' }}">
                {{ __('app/menu.contact') }}
            </a>

            <div class="px-2 pt-3 pb-0 space-y-3 bg-white border-t border-gray-200">
                <a href="{{ url('/login') }}"
                    class="w-full flex items-center justify-center gap-2 btn-secondary text-base py-2.5 hover:bg-primary-50">
                    <x-lucide-log-in class="w-5 h-5" />
                    <span>{{ __('app/menu.login') }}</span>
                </a>

                <a href="{{ url('/register') }}"
                    class="w-full flex items-center justify-center gap-2 btn-primary text-base py-2.5">
                    <x-lucide-user-plus class="w-5 h-5" />
                    <span>{{ __('app/menu.register') }}</span>
                </a>
            </div>
        </div>
    </div>
</nav>
