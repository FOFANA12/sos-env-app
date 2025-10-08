@extends('layouts.app')
@section('title', __('app/user.page_title.create'))

@section('content')
<div class="max-w-7xl mx-auto py-4">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                {{ __('app/report.breadcrumb.create.title') }}
            </h1>
            <p class="text-gray-600 text-sm">
                {{ __('app/report.breadcrumb.create.active') }}
            </p>
        </div>
    </div>

    <!-- Form -->
    <div class="sm:px-6 lg:px-0">
        <report-create context="create"></report-create>
    </div>
</div>
@endsection
