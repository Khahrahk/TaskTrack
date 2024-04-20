@extends('layouts.contentLayoutMaster')

@section('title', 'Dashboard')

@section('vendor-style')
@endsection

@section('page-style')

@endsection

@section('header')
    <nav class="navbar navbar-page navbar-expand-lg bg-white d-flex flex-row w-100 ps-3 pb-1"
         style="margin: 0; box-shadow: none; border-bottom:  1px solid rgba(0, 0, 0, 0.1); height: 45px">
        <x-button class="toggle-right close" size="sm" monochrome outline iconRight="burger-menu-svgrepo-com"></x-button>

        <div class="container-fluid">

        </div>
    </nav>
@endsection

@section('content')
    <div class="d-flex flex-row justify-content-center pt-5">
        <h1><span class="label">Dashboard</span></h1>
    </div>
@endsection

@section('vendor-script')
@endsection

@section('page-script')
@endsection
