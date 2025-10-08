<!-- Settings Dropdown -->
<div class="relative" x-data="{ open: false }" @click.away="open = false">
    <!-- Trigger -->
    <button @click="open = !open"
        class="flex items-center gap-2 text-sm text-gray-700 hover:text-primary-600 transition-colors p-2.5">
        <x-lucide-settings class="w-8 lg:w-5 h-8 lg:h-5" />
        <span class="hidden lg:flex font-medium">{{ __('app/menu.settings') }}</span>
        <x-lucide-chevron-down class="hidden lg:flex w-4 h-4 transition-transform duration-200"
            x-bind:class="{ 'rotate-180': open }" />
    </button>

    <!-- Dropdown Menu -->
    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 mt-2.5 lg:mt-4 w-60 bg-white border border-gray-200 rounded-xl shadow-lg py-2 z-50"
        @click.stop>
        <!-- Menu Items -->
        <div class="py-1">
            <a href="{{ route('users.index') }}"
                class="flex items-center px-4 py-2 text-sm transition-colors
                    {{ request()->routeIs('users.*')
                        ? 'bg-primary-50 text-primary-600 font-medium'
                        : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' }}">
                <x-lucide-users class="w-4 h-4 mr-2" />
                {{ __('app/menu.users') }}
            </a>

            <a href="{{ route('regions.index') }}"
                class="flex items-center px-4 py-2 text-sm transition-colors
                    {{ request()->routeIs('regions.*')
                        ? 'bg-primary-50 text-primary-600 font-medium'
                        : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' }}">
                <x-lucide-map class="w-4 h-4 mr-2" />
                {{ __('app/menu.regions') }}
            </a>

            <a href="{{ route('departments.index') }}"
                class="flex items-center px-4 py-2 text-sm transition-colors
                    {{ request()->routeIs('departments.*')
                        ? 'bg-primary-50 text-primary-600 font-medium'
                        : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' }}">
                <x-lucide-building class="w-4 h-4 mr-2" />
                {{ __('app/menu.departments') }}
            </a>

            <a href="{{ route('neighborhoods.index') }}"
                class="flex items-center px-4 py-2 text-sm transition-colors
                    {{ request()->routeIs('neighborhoods.*')
                        ? 'bg-primary-50 text-primary-600 font-medium'
                        : 'text-gray-700 hover:bg-primary-50 hover:text-primary-600' }}">
                <x-lucide-map-pin class="w-4 h-4 mr-2" />
                {{ __('app/menu.neighborhoods') }}
            </a>
        </div>
    </div>
</div>

<!-- CSS Alpine helper -->
<style>
    [x-cloak] {
        display: none !important;
    }
</style>
