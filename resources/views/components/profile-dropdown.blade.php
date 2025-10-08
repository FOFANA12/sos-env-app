<!-- Profile Dropdown -->
<div class="relative" x-data="{ open: false }" @click.away="open = false">
    <button @click="open = !open"
        class="flex items-center gap-2 text-sm text-gray-700 hover:text-primary-600 transition-colors p-2.5">
        @php
            $user = Auth::user();
            $initials = collect(explode(' ', $user->name))
                ->map(fn($part) => mb_substr($part, 0, 1))
                ->join('');
        @endphp

        @if ($user->avatar_url)
            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
                class="h-8 w-8 rounded-full border-gray-200 object-cover" />
        @else
            <div class="h-8 w-8 rounded-full bg-primary-600 flex items-center justify-center text-white font-semibold">
                {{ $initials }}
            </div>
        @endif
    </button>

    <!-- Dropdown Menu -->
    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 mt-2.5 w-60 bg-white border border-gray-200 rounded-xl shadow-lg py-2 z-50" @click.stop>
        <div class="px-2 py-2 border-b border-gray-100">
            <div class="flex items-center space-x-3">
                <img src="{{ Auth::user()->avatar_url ?? asset('images/no-avatar.png') }}"
                    alt="{{ Auth::user()->name }}" class="h-10 w-10 rounded-full border-gray-200 object-cover" />
                <div>
                    <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>

        <div class="py-0">
            <a href="{{ route('profile') }}"
                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                <x-lucide-user class="w-4 h-4 mr-2" />
                {{ __('app/menu.profile') }}
            </a>
        </div>

        <div class="border-t border-gray-100 my-0"></div>

        <div id="vue-logout"></div>

        {{-- <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors text-left">
                <x-lucide-log-out class="w-4 h-4 mr-2" />
                {{ __('app/menu.logout') }}
            </button>
        </form> --}}
    </div>
</div>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
