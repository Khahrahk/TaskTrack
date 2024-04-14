@extends('layouts.contentLayoutMaster')

@section('title', 'Dashboard')

@section('vendor-style')
@endsection

@section('page-style')

@endsection

@section('header')
    <nav class="navbar navbar-expand-lg bg-light d-flex flex-row w-100 ps-3 pb-1"
         style="margin: 0; box-shadow: none; border-bottom:  1px solid rgba(0, 0, 0, 0.1)">
        <button type="button" id="sidebarCollapse" class="btn btn-info py-3"><i class="fa fa-align-justify"></i></button>

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
