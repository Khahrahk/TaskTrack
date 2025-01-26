@extends('layouts.app')

@section('title', 'Подтвердите e-mail')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('css/plugins/forms/form-validation.css')) }}">
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/pages/auth/authentication.css')) }}">
@endsection

@section('content')
    @include('partials.header')

    <p>Необходимо подтверждение e-mail</p>

    <a href="{{ route('verification.send') }}">
        Отправить повторно
    </a>
@endsection

@section('vendor-script')
    <script src="{{asset(mix('js/plugins/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
    <script src="{{asset(mix('js/pages/auth/auth-login.js'))}}"></script>
@endsection
