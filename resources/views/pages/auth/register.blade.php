@extends('layouts.auth')
@section('title', __('app/auth/register.page_title'))

@section('content')
    @if (session('success'))
        <x-toast type="success" :message="session('success')" :duration="15000" position="top-10 right-5" />
    @endif
    @if (session('error'))
        <x-toast type="danger" :message="session('error')" :duration="15000" position="top-10 right-5" />
    @endif
    <register-form></register-form>
@endsection
