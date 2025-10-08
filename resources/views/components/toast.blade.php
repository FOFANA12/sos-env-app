@props([
    'type' => 'success', // success | danger | warning | info
    'message' => '',
    'duration' => 6000, // duration in ms
    'position' => 'top-20 right-5'
])

@php
    $bgColors = [
        'success' => 'bg-green-500',
        'danger' => 'bg-red-500',
        'warning' => 'bg-yellow-500',
        'info' => 'bg-blue-500',
    ];

    $icon = match ($type) {
        'success' => 'check-circle',
        'danger' => 'x-circle',
        'warning' => 'alert-triangle',
        'info' => 'info',
        default => 'info',
    };

    $bgClass = $bgColors[$type] ?? 'bg-gray-800';
@endphp

<div 
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, {{ $duration }})"
    x-show="show"
    x-transition:enter="transform ease-out duration-300 transition"
    x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
    x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed {{ $position }} z-[9999] max-w-sm w-full shadow-lg rounded-lg pointer-events-auto"
>
    <div class="flex items-center {{ $bgClass }} text-white px-4 py-3 rounded-lg shadow-md">
        {{-- Icon --}}
        <x-dynamic-component :component="'lucide-' . $icon" class="w-5 h-5 mr-2 text-white" />

        {{-- Message --}}
        <p class="text-sm font-medium flex-1">{{ $message }}</p>

        {{-- Close --}}
        <button @click="show = false" class="ml-3 text-white hover:text-gray-200">
            <x-lucide-x class="w-4 h-4" />
        </button>
    </div>
</div>
