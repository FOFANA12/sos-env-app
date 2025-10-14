@extends('layouts.app')
@section('title', __('app/about.page_title'))

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-white via-green-50 to-emerald-100">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle at 1px 1px, rgba(34, 197, 94, 0.3) 1px, transparent 0); background-size: 20px 20px;">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight text-gray-900">
                {{ __('app/about.hero_title') }}
            </h1>
            <p class="text-xl md:text-2xl mb-12 max-w-4xl mx-auto text-gray-700 leading-relaxed">
                {{ __('app/about.hero_subtitle') }}
            </p>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 md:px-0">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ __('app/about.mission_title') }}</h2>
                    <p class="text-lg text-gray-600 mb-4">{{ __('app/about.mission_p1') }}</p>
                    <p class="text-lg text-gray-600 mb-6">{{ __('app/about.mission_p2') }}</p>
                    <ul class="space-y-3">
                        <li class="flex items-start space-x-3">
                            <x-lucide-check class="w-6 h-6 text-primary-600 mt-0.5" />
                            <span class="text-gray-700">{{ __('app/about.mission_point1') }}</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <x-lucide-check class="w-6 h-6 text-primary-600 mt-0.5" />
                            <span class="text-gray-700">{{ __('app/about.mission_point2') }}</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <x-lucide-check class="w-6 h-6 text-primary-600 mt-0.5" />
                            <span class="text-gray-700">{{ __('app/about.mission_point3') }}</span>
                        </li>
                    </ul>
                </div>
                <div class="bg-primary-50 rounded-2xl p-8 text-center">
                    <div
                        class="w-20 h-20 bg-gradient-to-br from-primary-500 to-primary-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <x-lucide-sun class="w-10 h-10 text-white" />
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('app/about.vision_title') }}</h3>
                    <p class="text-gray-600">{{ __('app/about.vision_text') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __('app/about.values_title') }}</h2>
                <p class="text-xl text-gray-600">{{ __('app/about.values_subtitle') }}</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">

                <!-- Value: Engagement -->
                <div class="group">
                    <div
                        class="bg-white rounded-3xl shadow-sm border border-gray-50 p-10 text-center hover:shadow-sm hover:-translate-y-3 transition-all duration-500 h-full relative overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-5 transform rotate-12 translate-x-8 -translate-y-8 text-red-500">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <div
                                class="w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl bg-gradient-to-br from-red-500 to-pink-600">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4 group-hover:text-primary-600 transition-colors">
                                {{ __('app/about.value_engagement') }}</h3>
                            <p class="text-gray-600 leading-relaxed text-base"> {{ __('app/about.value_engagement_text') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Value: Transparence -->
                <div class="group">
                    <div
                        class="bg-white rounded-3xl shadow-sm border border-gray-50 p-10 text-center hover:shadow-sm hover:-translate-y-3 transition-all duration-500 h-full relative overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-5 transform rotate-12 translate-x-8 -translate-y-8 text-blue-500">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <div
                                class="w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl bg-gradient-to-br from-blue-500 to-indigo-600">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                            <h3
                                class="text-xl font-bold text-gray-900 mb-4 mb-6 group-hover:text-primary-600 transition-colors">
                                {{ __('app/about.value_transparency') }}</h3>
                            <p class="text-gray-600 leading-relaxed text-base">
                                {{ __('app/about.value_transparency_text') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Value: Collaboration -->
                <div class="group">
                    <div
                        class="bg-white rounded-3xl shadow-sm border border-gray-50 p-10 text-center hover:shadow-sm hover:-translate-y-3 transition-all duration-500 h-full relative overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-5 transform rotate-12 translate-x-8 -translate-y-8 text-green-500">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <div
                                class="w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-2xl bg-gradient-to-br from-green-500 to-emerald-600">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3
                                class="text-xl font-bold text-gray-900 mb-4 group-hover:text-primary-600 transition-colors">
                                {{ __('app/about.value_collaboration') }}</h3>
                            <p class="text-gray-600 leading-relaxed text-base">
                                {{ __('app/about.value_collaboration_text') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <div
                    class="inline-block bg-gradient-to-r from-primary-100 to-accent-100 text-primary-700 px-6 py-2 rounded-full text-sm font-semibold mb-6">
                    {{ __('app/about.impact_badge') }}
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __('app/about.impact_title') }}</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    {{ __('app/about.impact_subtitle') }}
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">

                <!-- Impact 1 : Reports -->
                <div class="group">
                    <div
                        class="bg-white rounded-3xl shadow-sm border border-gray-50 p-10 text-center hover:shadow-sm hover:-translate-y-3 transition-all duration-500 h-full relative overflow-hidden group-hover:scale-105">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-5 transform rotate-12 translate-x-8 -translate-y-8 text-blue-500">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <div
                                class="w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-lg bg-gradient-to-br from-blue-500 to-blue-600">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>

                            <div
                                class="text-5xl font-black mb-4 bg-gradient-to-r from-blue-500 to-blue-700 bg-clip-text text-transparent">
                                {{ number_format($stats['reports_count']) }}</div>

                            <div class="text-xl font-bold text-gray-900 mb-4">
                                {{ __('app/about.impact_reports') }}
                            </div>
                            <div class="text-gray-600 leading-relaxed text-base">
                                {{ __('app/about.impact_reports_text') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Impact: Solved reports -->
                <div class="group">
                    <div
                        class="bg-white rounded-3xl shadow-sm border border-gray-50 p-10 text-center hover:shadow-sm hover:-translate-y-3 transition-all duration-500 h-full relative overflow-hidden group-hover:scale-105">
                        <!-- Background decoration -->
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-5 transform rotate-12 translate-x-8 -translate-y-8 text-green-500">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <div
                                class="w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-lg bg-gradient-to-br from-green-500 to-green-600">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>

                            <div
                                class="text-5xl font-black mb-4 bg-gradient-to-r from-green-500 to-green-700 bg-clip-text text-transparent">
                                 {{ number_format($stats['resolved_count']) }}</div>
                            <div class="text-xl font-bold text-gray-900 mb-4">{{ __('app/about.impact_resolved') }}</div>
                            <div class="text-gray-600 leading-relaxed text-base">{{ __('app/about.impact_resolved_text') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Impact: Wilayas -->
                <div class="group">
                    <div
                        class="bg-white rounded-3xl shadow-sm border border-gray-50 p-10 text-center hover:shadow-sm hover:-translate-y-3 transition-all duration-500 h-full relative overflow-hidden group-hover:scale-105">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-5 transform rotate-12 translate-x-8 -translate-y-8 text-purple-500">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <div
                                class="w-20 h-20 rounded-3xl flex items-center justify-center mx-auto mb-8 shadow-lg bg-gradient-to-br from-purple-500 to-purple-600">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>

                            <div
                                class="text-5xl font-black mb-4 bg-gradient-to-r from-purple-500 to-purple-700 bg-clip-text text-transparent">
                                {{ number_format($stats['regions_count']) }}</div>
                            <div class="text-xl font-bold text-gray-900 mb-4">{{ __('app/about.impact_regions') }}</div>
                            <div class="text-gray-600 leading-relaxed text-base">{{ __('app/about.impact_regions_text') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <div
                    class="inline-block bg-gradient-to-r from-primary-100 to-accent-100 text-primary-700 px-6 py-2 rounded-full text-sm font-semibold mb-4">
                    {{ __('app/about.partners_badge') }}
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-4">{{ __('app/about.partners_title') }}</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">{{ __('app/about.partners_subtitle') }}</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">

                <!-- Partner 1 -->
                <div class="group">
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-sm hover:-translate-y-2 transition-all duration-500 h-full flex flex-col items-center justify-center relative overflow-hidden">
                        <!-- Background decoration -->
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-5 transform rotate-12 translate-x-8 -translate-y-8 text-green-500">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2L15.09 8H21L16.18 12.26L18.18 19L12 15.77L5.82 19L7.82 12.26L3 8H8.91L12 2Z" />
                            </svg>
                        </div>

                        <div class="relative z-10 flex flex-col items-center justify-center h-full">
                            <!-- Logo -->
                            <div
                                class="w-40 h-40 mb-6 flex items-center justify-center rounded-2xl p-4 transition-all duration-300">
                                <img src="{{ asset('images/partners/partner-1.jpg') }}" alt="Partner 1"
                                    class="max-w-full max-h-full object-contain transition-all duration-500">
                            </div>

                            <!-- Info -->
                            <h3
                                class="text-lg font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors">
                                Partner 1
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Partner 2 -->
                <div class="group">
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-sm hover:-translate-y-2 transition-all duration-500 h-full flex flex-col items-center justify-center relative overflow-hidden">
                        <!-- Background decoration -->
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-5 transform rotate-12 translate-x-8 -translate-y-8 text-blue-500">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2a10 10 0 100 20 10 10 0 000-20z" />
                            </svg>
                        </div>

                        <div class="relative z-10 flex flex-col items-center justify-center h-full">
                            <!-- Logo -->
                            <div
                                class="w-40 h-40 mb-6 flex items-center justify-center rounded-2xl p-4 transition-all duration-300">
                                <img src="{{ asset('images/partners/partner-2.jpg') }}" alt="Partner 2"
                                    class="max-w-full max-h-full object-contain transition-all duration-500">
                            </div>

                            <!-- Info -->
                            <h3
                                class="text-lg font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors">
                                Partner 2
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Partner 3 -->
                <div class="group">
                    <div
                        class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center hover:shadow-sm hover:-translate-y-2 transition-all duration-500 h-full flex flex-col items-center justify-center relative overflow-hidden">
                        <!-- Background decoration -->
                        <div
                            class="absolute top-0 right-0 w-32 h-32 opacity-5 transform rotate-12 translate-x-8 -translate-y-8 text-yellow-500">
                            <svg class="w-full h-full" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4 4h16v16H4z" />
                            </svg>
                        </div>

                        <div class="relative z-10 flex flex-col items-center justify-center h-full">
                            <!-- Logo -->
                            <div
                                class="w-40 h-40 mb-6 flex items-center justify-center rounded-2xl p-4 transition-all duration-300">
                                <img src="{{ asset('images/partners/partner-3.jpg') }}" alt="Partner 3"
                                    class="max-w-full max-h-full object-contain transition-all duration-500">
                            </div>

                            <!-- Info -->
                            <h3
                                class="text-lg font-bold text-gray-900 mb-3 group-hover:text-primary-600 transition-colors">
                                Partner 3
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @guest
        <!-- CTA Section -->
        <section class="py-16 bg-gradient-to-br from-white via-green-50 to-emerald-100 relative overflow-hidden">
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0"
                    style="background-image: radial-gradient(circle at 1px 1px, rgba(34, 197, 94, 0.3) 1px, transparent 0); background-size: 20px 20px;">
                </div>
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">{{ __('app/about.cta_title') }}</h2>
                <p class="text-xl text-gray-700 mb-8 max-w-3xl mx-auto leading-relaxed">
                    {{ __('app/about.cta_subtitle') }}
                </p>
                <a href="{{ url('/register') }}"
                    class="bg-green-600 text-white px-8 py-3 rounded-xl font-semibold hover:bg-green-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 transform inline-flex items-center group">
                    <span class="mr-2">{{ __('app/about.cta_btn') }}</span>
                    <x-lucide-user-plus class="w-5 h-5" />
                </a>
            </div>
        </section>
    @endguest

@endsection
