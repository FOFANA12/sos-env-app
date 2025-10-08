@extends('layouts.app')
@section('title', __('app/user.page_title.show'))

@section('content')
    <div class="max-w-7xl mx-auto">
        <user-show context="edit"></user-show>
    </div>
@endsection
