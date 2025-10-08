@extends('layouts.app')

@section('title', __('app/privacy.pageTitle'))

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-gradient-to-br from-white via-green-50 to-emerald-100">
            <div class="absolute inset-0 opacity-5">
                <div class="absolute inset-0"
                    style="background-image: radial-gradient(circle at 1px 1px, rgba(34, 197, 94, 0.3) 1px, transparent 0); background-size: 20px 20px;">
                </div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight text-gray-900">
                    {{ __('app/privacy.pageTitle') }}
                </h1>
                <p class="text-xl md:text-2xl mb-12 max-w-4xl mx-auto text-gray-700 leading-relaxed">
                    {{ __('app/privacy.pageSubtitle') }}
                </p>
            </div>
        </section>

        <!-- Content -->
        <section class="py-12">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
                    <!-- Last Updated -->
                    <div class="bg-gray-50 px-8 py-4 border-b border-gray-200">
                        <p class="text-sm text-gray-600">
                            <span
                                class="font-medium">{{ __('app/privacy.lastUpdated', ['date' => '8 octobre 2025']) }}</span>
                        </p>
                    </div>

                    <!-- Privacy Content -->
                    <div class="p-8 md:p-12">
                        <div class="prose prose-lg max-w-none">
                            @php
                                $app = '<strong>' . config('app.name') . '</strong>';
                                $sections = __('app/privacy.sections');
                            @endphp

                            <!-- 1. Introduction -->
                            <div class="mb-12">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-primary-600 font-bold text-sm">1</span>
                                    </div>
                                    {{ $sections['intro']['title'] }}
                                </h2>
                                @foreach ($sections['intro']['paragraphs'] as $p)
                                    <p class="text-gray-700 leading-relaxed mb-4">{!! str_replace(':app', $app, $p) !!}</p>
                                @endforeach
                            </div>

                            <!-- 2. Collecte des données -->
                            <div class="mb-12">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-primary-600 font-bold text-sm">2</span>
                                    </div>
                                    {{ $sections['collection']['title'] }}
                                </h2>

                                <p class="text-gray-700 leading-relaxed mb-6">
                                    {{ $sections['collection']['intro'] }}
                                </p>

                                <!-- a. Informations personnelles -->
                                <div class="bg-blue-50 rounded-lg p-6 mb-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ $sections['collection']['personalData']['title'] }}
                                    </h3>
                                    <ul class="space-y-2 text-gray-700">
                                        @foreach ($sections['collection']['personalData']['items'] as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- b. Données de signalement -->
                                <div class="bg-green-50 rounded-lg p-6 mb-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                        <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                        {{ $sections['collection']['reportData']['title'] }}
                                    </h3>
                                    <ul class="space-y-2 text-gray-700">
                                        @foreach ($sections['collection']['reportData']['items'] as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <!-- 3. Utilisation des données -->
                            <div class="mb-12">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-primary-600 font-bold text-sm">3</span>
                                    </div>
                                    {{ $sections['usage']['title'] }}
                                </h2>
                                <p class="text-gray-700 leading-relaxed mb-6">
                                    {{ $sections['usage']['intro'] }}
                                </p>
                                <ul class="space-y-3 text-gray-700">
                                    @foreach ($sections['usage']['items'] as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- 4. Partage des données -->
                            <div class="mb-12">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-primary-600 font-bold text-sm">4</span>
                                    </div>
                                    {{ $sections['sharing']['title'] }}
                                </h2>
                                <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                                    <p class="text-red-800">
                                        <strong> {{ $sections['sharing']['alertPart1'] }}</strong>
                                        {{ $sections['sharing']['alertPart2'] }}
                                    </p>
                                </div>
                                <p class="text-gray-700 leading-relaxed mb-6">
                                    {{ $sections['sharing']['intro'] }}
                                </p>
                                <ul class="space-y-3 text-gray-700">
                                    @foreach ($sections['sharing']['items'] as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- 5. Sécurité des données -->
                            <div class="mb-12">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-primary-600 font-bold text-sm">5</span>
                                    </div>
                                    {{ $sections['security']['title'] }}
                                </h2>
                                <p class="text-gray-700 leading-relaxed mb-6">
                                    {!! str_replace(':app', '<strong>' . config('app.name') . '</strong>', $sections['security']['intro']) !!}
                                </p>
                                </p>
                                <ul class="space-y-3 text-gray-700">
                                    @foreach ($sections['security']['items'] as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- 6. Vos droits -->
                            <div class="mb-12">
                                <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-primary-600 font-bold text-sm">6</span>
                                    </div>
                                    {{ $sections['rights']['title'] }}
                                </h2>
                                <p class="text-gray-700 leading-relaxed mb-6">
                                    {{ $sections['rights']['intro'] }}
                                </p>
                                <ul class="list-disc ml-6 space-y-2 text-gray-700">
                                    @foreach ($sections['rights']['items'] as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- 7. Contact -->
                            <div class="bg-primary-50 rounded-xl p-8">
                                <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-6 h-6 text-primary-600 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    {{ $sections['contact']['title'] }}
                                </h2>
                                <p class="text-gray-700">
                                    <strong>{{ $sections['contact']['labelEmail'] }} : </strong>
                                    <a href="mailto:{{ $sections['contact']['email'] }}"
                                        class="text-primary-600 hover:text-primary-700">{{ $sections['contact']['email'] }}</a>
                                </p>
                                <p class="text-gray-700">
                                    <strong>{{ $sections['contact']['labelAddress'] }} : </strong>
                                    {{ $sections['contact']['address'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
