@extends('layouts.app')
@section('title', __('app/user.page_title.edit'))

@section('content')
    <div class="max-w-7xl mx-auto">
        <user-edit context="edit"></user-edit>
    </div>
@endsection
