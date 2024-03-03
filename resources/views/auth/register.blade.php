@extends('layouts.app')

@section('title', 'Регистрация')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('css/plugins/forms/form-validation.css')) }}">
@endsection

@section('page-style')
    <link rel="stylesheet" href="{{ asset(mix('css/pages/auth/authentication.css')) }}">
@endsection

@section('content')
{{--    <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">--}}
{{--        <div class="bg-white w-96 shadow-xl rounded p-5">--}}
{{--            <h1 class="text-3xl font-medium">Регистрация</h1>--}}

{{--            <form action="{{ route("register_process") }}" class="space-y-5 mt-5" method="POST">--}}
{{--                @csrf--}}

{{--                <input name="name" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('name') border-red-500 @enderror" placeholder="Имя" />--}}

{{--                @error('name')--}}
{{--                <p class="text-red-500">{{ $message }}</p>--}}
{{--                @enderror--}}

{{--                <input name="email" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('email') border-red-500 @enderror" placeholder="Email" />--}}

{{--                @error('email')--}}
{{--                    <p class="text-red-500">{{ $message }}</p>--}}
{{--                @enderror--}}

{{--                <input name="password" type="password" class="w-full h-12 border border-gray-800 rounded px-3 @error('password') border-red-500 @enderror" placeholder="Пароль" />--}}

{{--                @error('password')--}}
{{--                    <p class="text-red-500">{{ $message }}</p>--}}
{{--                @enderror--}}

{{--                <input name="password_confirmation" type="password" class="w-full h-12 border border-gray-800 rounded px-3 @error('password_confirmation') border-red-500 @enderror" placeholder="Подтверждение пароля" />--}}

{{--                @error('password_confirmation')--}}
{{--                    <p class="text-red-500">{{ $message }}</p>--}}
{{--                @enderror--}}

{{--                <div>--}}
{{--                    <a href="{{ route("login") }}" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">Есть аккаунт?</a>--}}
{{--                </div>--}}

{{--                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Зарегистрироваться</button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}

<div class="auth-wrapper auth-cover">
    <div class="auth-inner d-flex flex-row m-0">
        <div class="d-flex flex-column col-12 align-items-center auth-bg p-0">
            <div class="content col-sm-9 col-md-6 col-lg-3" style="min-width: 300px;">
                <div class="login-island" style="padding-top: 50%">
                    <div class="header d-lg-flex flex-column col-lg-12 align-items-center justify-content-center pb-4">
                        <h1><span class="label">TaskTrack</span></h1>
                    </div>
                    <form method="POST" action="{{ route("login_process") }}" class="card w-100">
                        <h5 class="card-header d-flex flex-column align-items-center justify-content-center">Sign up</h5>
                        <div class="card-body p-3">
                            @csrf
                            <div class="form d-flex flex-column gap-3">
                                <x-input name="name" label-top error-less placeholder="Username" :value="old('login')" wrapper-class="w-100" required />
                                <x-input name="email" label-top error-less placeholder="Email" :value="old('login')" wrapper-class="w-100" required />
                                <x-input name="password" type="password" label-top error-less placeholder="Password" wrapper-class="w-100" required />
                                <x-input name="password_confirmation" type="password" label-top error-less placeholder="Password confirmation" wrapper-class="w-100" required />
                            @if($errors->any())
                                    <div class="invalid-feedback d-block">{{ $errors->first() }}</div>
                                @endif
                            </div>
                            <div class="d-flex flex-row py-3 justify-content-between">
                                <x-button link primary :href="route('forgot')" label="Forgot password ?" />
                                <x-button link primary :href="route('login')" label="Sign in" />
                            </div>
                            <div class="d-flex flex-column action">
                                <x-button outline primary full label="Sign up" type="submit" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('vendor-script')
    <script src="{{asset(mix('js/plugins/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
    <script src="{{asset(mix('js/pages/auth/auth-login.js'))}}"></script>
@endsection
