@extends('layouts.app')
@section('title', __('app/profile.page_title.show'))

@section('content')
    <div class="max-w-7xl mx-auto">
        <profile-form :flash-message='@json(session("success"))'></profile-form>
    </div>
@endsection
