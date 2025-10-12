@extends('layouts.app')
@section('title', __('app/report.page_title.index'))

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-white via-green-50 to-emerald-100">
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0"
                style="background-image: radial-gradient(circle at 1px 1px, rgba(34, 197, 94, 0.3) 1px, transparent 0); background-size: 20px 20px;">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto py-6">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight text-gray-900">
                    {{ __('app/report.hero_title') }}
                </h1>
                <p class="text-xl max-w-3xl mx-auto mb-8 leading-relaxed text-gray-700">
                    {{ __('app/report.hero_subtitle') }}
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('reports.create') }}"
                        class="border-2 border-green-600 text-green-600 px-8 py-3 rounded-lg font-semibold 
                               hover:bg-green-50 transition-all duration-300 inline-flex items-center justify-center group">
                        <x-lucide-plus class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform duration-300" />
                        {{ __('app/report.new_report_btn') }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Reports list -->
    <div class="max-w-7xl mx-auto">
        <report-index></report-index>
    </div>
@endsection
