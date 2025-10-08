@extends('layouts.app')

@section('title', __('app/terms.pageTitle'))

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
                    {{ __('app/terms.pageTitle') }}
                </h1>
                <p class="text-xl md:text-2xl mb-12 max-w-4xl mx-auto text-gray-700 leading-relaxed">
                    {!! __('app/terms.pageSubtitle', ['app' => '<strong>' . config('app.name') . '</strong>']) !!}
                </p>
            </div>
        </section>

        <!-- Content -->
        <section class="py-10">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                    <!-- Last Updated -->
                    <div class="bg-gray-50 px-8 py-4 border-b border-gray-200">
                        <p class="text-sm text-gray-600">
                            <span class="font-medium">{{ __('app/terms.lastUpdated', ['date' => '8 octobre 2025']) }}</span>
                        </p>
                    </div>

                    <!-- Terms Content -->
                    <div class="p-8 md:p-12">
                        <div class="prose prose-lg max-w-none">
                            @php
                                $app = '<strong>' . config('app.name') . '</strong>';
                                $sections = __('app/terms.sections');
                            @endphp

                            <!-- 1. Introduction -->
                            <div class="mb-12">
                                <div class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-primary-600 font-bold text-sm">1</span>
                                    </div>
                                    {{ $sections['intro']['title'] }}
                                </div>
                                @foreach ($sections['intro']['paragraphs'] as $p)
                                    <p class="text-gray-700 leading-relaxed mb-4">{!! str_replace(':app', $app, $p) !!}</p>
                                @endforeach
                            </div>

                            <!-- 2. Acceptation -->
                            <div class="mb-12">
                                <div class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-primary-600 font-bold text-sm">2</span>
                                    </div>
                                    {{ $sections['acceptance']['title'] }}
                                </div>
                                @foreach ($sections['acceptance']['paragraphs'] as $p)
                                    <p class="text-gray-700 leading-relaxed mb-4">{!! $p !!}</p>
                                @endforeach
                            </div>

                            <!-- 3. Utilisation -->
                            <div class="mb-12">
                                <div class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-primary-600 font-bold text-sm">3</span>
                                    </div>
                                    {{ $sections['usage']['title'] }}
                                </div>
                                <p class="text-gray-700 leading-relaxed mb-6">{!! str_replace(':app', $app, $sections['usage']['intro']) !!}</p>
                                <ul class="space-y-3 mb-6">
                                    @foreach ($sections['usage']['rules'] as $rule)
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-green-500 mt-0.5 mr-3 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span class="text-gray-700">{{ $rule }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- 4. Signalements -->
                            <div class="mb-12">
                                <div class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-primary-600 font-bold text-sm">4</span>
                                    </div>
                                    {{ $sections['reports']['title'] }}
                                </div>
                                <p class="text-gray-700 leading-relaxed mb-4">{{ $sections['reports']['intro'] }}</p>
                                <ul class="space-y-3 mb-6">
                                    @foreach ($sections['reports']['rules'] as $item)
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-gray-700">{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                    <p class="text-yellow-800 text-sm">{!! str_replace(':app', $app, $sections['reports']['warning']) !!}</p>
                                </div>
                            </div>

                            <!-- 5. Responsabilité -->
                            <div class="mb-12">
                                <div class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-primary-600 font-bold text-sm">5</span>
                                    </div>
                                    {{ $sections['responsibility']['title'] }}
                                </div>
                                <p class="text-gray-700 leading-relaxed mb-4">{!! str_replace(':app', $app, $sections['responsibility']['intro']) !!}</p>
                                <ul class="space-y-3 mb-6">
                                    @foreach ($sections['responsibility']['limits'] as $limit)
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-gray-400 mt-0.5 mr-3 flex-shrink-0" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-gray-700">{{ $limit }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <p class="text-gray-700 leading-relaxed">{{ $sections['responsibility']['note'] }}</p>
                            </div>

                            <!-- 6. Comptes -->
                            <div class="mb-12">
                                <div class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-primary-600 font-bold text-sm">6</span>
                                    </div>
                                    {{ $sections['accounts']['title'] }}
                                </div>
                                @foreach ($sections['accounts']['paragraphs'] as $p)
                                    <p class="text-gray-700 leading-relaxed mb-4">{!! str_replace(':email', '<strong>support@sos-environnement.mr</strong>', $p) !!}</p>
                                @endforeach
                            </div>

                            <!-- 7. Données personnelles -->
                            <div class="mb-12">
                                <div class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-primary-600 font-bold text-sm">7</span>
                                    </div>
                                    {{ $sections['privacy']['title'] }}
                                </div>
                                @foreach ($sections['privacy']['paragraphs'] as $p)
                                    <p class="text-gray-700 leading-relaxed mb-4">{!! str_replace(':link', route('privacy'), $p) !!}</p>
                                @endforeach
                            </div>

                            <!-- 9. Propriété intellectuelle -->
                            <div class="mb-12">
                                <div class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-primary-600 font-bold text-sm">9</span>
                                    </div>
                                    {{ $sections['intellectual']['title'] }}
                                </div>
                                @foreach ($sections['intellectual']['paragraphs'] as $p)
                                    <p class="text-gray-700 leading-relaxed mb-4">{!! str_replace(':app', $app, $p) !!}</p>
                                @endforeach
                            </div>

                            <!-- 11. Droit applicable -->
                            <div class="mb-12">
                                <div class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-primary-600 font-bold text-sm">11</span>
                                    </div>
                                    {{ $sections['law']['title'] }}
                                </div>
                                @foreach ($sections['law']['paragraphs'] as $p)
                                    <p class="text-gray-700 leading-relaxed mb-4">{{ $p }}</p>
                                @endforeach
                            </div>

                            <!-- 12. Modifications -->
                            <div class="mb-12">
                                <div class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                    <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                        <span class="text-primary-600 font-bold text-sm">12</span>
                                    </div>
                                    {{ $sections['changes']['title'] }}
                                </div>
                                @foreach ($sections['changes']['paragraphs'] as $p)
                                    <p class="text-gray-700 leading-relaxed mb-4">{{ $p }}</p>
                                @endforeach
                            </div>

                            <!-- 13. Contact -->
                            <div class="bg-primary-50 rounded-xl p-8">
                                <div class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-6 h-6 text-primary-600 mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    {{ $sections['contact']['title'] }}
                                </div>
                                <p class="text-gray-700 leading-relaxed mb-4">{{ $sections['contact']['intro'] }}</p>
                                <div class="space-y-2">
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
            </div>
        </section>
    </div>
@endsection
