@extends('layouts.app')

@section('title', __('app/error.500.title'))

@section('content')
    <div class="flex flex-col items-center justify-center text-center py-20 sm:py-28">

        <!-- Icon -->
        <div class="w-20 h-20 flex items-center justify-center rounded-full bg-red-100 mb-6">
            <x-lucide-zap class="w-10 h-10 text-red-600" />
        </div>

        <!-- Title -->
        <h1 class="text-4xl font-bold text-gray-900 mb-2">
            {{ __('app/error.500.heading') }}
        </h1>

        <p class="text-gray-600 text-base max-w-md mx-auto mb-8 leading-relaxed">
            {!! __('app/error.500.description') !!}
        </p>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-10">
            <button onclick="window.location.reload()"
                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 transition-colors">
                <x-lucide-refresh-ccw class="w-4 h-4" />
                {{ __('app/error.500.retry') }}
            </button>

            <a href="{{ route('home') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 transition-colors">
                <x-lucide-home class="w-4 h-4" />
                {{ __('app/error.500.home') }}
            </a>
        </div>
    </div>
@endsection
