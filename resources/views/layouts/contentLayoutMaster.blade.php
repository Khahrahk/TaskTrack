<!DOCTYPE html>
<html class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('images/ico/favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/ico/favicon.ico') }}">
    <link rel="manifest" href="{{ route('webmanifest') }}" crossorigin="use-credentials" />
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="application-name" content="{{ config('app.name') }}">
    <meta name="apple-mobile-web-app-status-bar-style" content="#f8f8f8">
    <meta name="apple-mobile-web-app-title" content="{{ config('app.name') }}">
    <meta name="theme-color" content="#f8f8f8">
    @include('panels/styles')
</head>
@isset($configData['mainLayoutType'])
    @extends('layouts.horizontalLayoutMaster')
@endisset
