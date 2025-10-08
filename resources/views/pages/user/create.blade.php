@extends('layouts.app')
@section('title', __('app/user.page_title.create'))

@section('content')
    <div class="max-w-7xl mx-auto">
        <user-create context="create"></user-create>
    </div>
@endsection
