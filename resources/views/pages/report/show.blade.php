@extends('layouts.app')
@section('title', __('app/report.page_title.show'))

@section('content')
    <div class="max-w-7xl mx-auto">
        <report-show context="edit"></report-show>
    </div>
@endsection
