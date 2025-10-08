@extends('layouts.auth')
@section('title', __('app/auth/reset_password.page_title'))

@section('content')
    <reset-password-form 
        token="{{ $token }}" 
        email="{{ $email }}">
    </reset-password-form>
@endsection
