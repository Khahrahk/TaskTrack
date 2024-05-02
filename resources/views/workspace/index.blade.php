@extends('layouts.contentLayoutMaster')

@section('title', 'Workspaces')

@section('vendor-style')
@endsection

@section('page-style')
    <style>
        .icons i {
            color: #b5b3b3;
            border: 1px solid #b5b3b3;
            padding: 6px;
            margin-left: 4px;
            border-radius: 5px;
            cursor: pointer;
        }

        .list-group li {
            margin-bottom: 12px;
        }

        .list li {
            list-style: none;
            padding: 10px;
            border: 1px solid #e3dada;
            margin-top: 12px;
            border-radius: 5px;
            background: #fff;
        }

        .img-holder {
            height: 55px;
            width: 55px;
            background-color: #4e63d7;
            background-image: -webkit-gradient(linear, left top, right top, from(rgba(78, 99, 215, 0.9)), to(#5a85dd));
            background-image: linear-gradient(to right, rgba(78, 99, 215, 0.9) 0%, #5a85dd 100%);
            font-family: "Open Sans", sans-serif;
            color: #fff;
            font-size: 22px;
            font-weight: 700;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            border-radius: 5px;
        }

        .profile-image img {
            margin-left: 3px;
        }
    </style>
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
    <div class="header d-flex flex-column col-lg-12 align-items-center justify-content-center pb-4 pt-4">
        <div class="d-flex flex-column w-100 align-items-center justify-content-center">
            <h1 class="d-flex flex-row"><span class="label">Workspaces</span></h1>
            <h5 class="d-flex flex-row">Create or join existing workspace</h5>
        </div>
        <div class="d-flex flex-row pt-3 w-100 align-items-center justify-content-center gap-3">
            <x-button outline primary label="Create" class="col-1" data-bs-toggle="modal" data-bs-target="#create"/>
            <x-button outline primary label="Join" class="col-1" data-bs-toggle="modal" data-bs-target="#join"/>
        </div>
    </div>
    <div class="d-flex flex-column col-12 align-items-center pb-4 pt-4">
        @if(!empty(auth()->user()->userWorkspace))
            @foreach(auth()->user()->userWorkspace as $workspace)
                <div class="d-flex flex-column col-6 p-3">
                    <div class="d-flex flex-row w-100 align-items-center gap-3">
                        <div class="d-flex flex-column w-10">
                            <div class="img-holder">
                                {{ $workspace->workspace->presenter()->initials }}
                            </div>
                        </div>
                        <div class="d-flex flex-column w-50">
                            <span><h1>{{ $workspace->workspace->name }}</h1></span>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <div class="modal fade" id="create" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route("workspace_create") }}">
                    <div class="modal-body">
                        @csrf
                        <div class="form d-flex flex-column gap-3">
                            <x-input name="name" label-top error-less placeholder="Name" wrapper-class="w-100"
                                     required/>
                            @if($errors->any())
                                <div class="invalid-feedback d-block">{{ $errors->first() }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <x-button outline monochrome label="Close" data-bs-dismiss="modal"/>
                        <x-button outline primary label="Submit" type="submit"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="join" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Join</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route("workspace_join") }}">
                    <div class="modal-body">
                        @csrf
                        <div class="form d-flex flex-column gap-3">
                            <x-input name="token" label-top error-less placeholder="Token" wrapper-class="w-100"
                                     required/>
                            @if($errors->any())
                                <div class="invalid-feedback d-block">{{ $errors->first() }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <x-button outline monochrome label="Close" data-bs-dismiss="modal"/>
                        <x-button outline primary label="Submit" type="submit"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('vendor-script')
@endsection

@section('page-script')
@endsection
