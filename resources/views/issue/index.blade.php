@extends('layouts.contentLayoutMaster')

@section('title', 'Issues')

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
            height: 35px;
            width: 35px;
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


        .container {
            transform: translate(0%, 0%);
            text-align: center;
        }

        .more-menu {
            width: 100px;
        }

        /* More Button / Dropdown Menu */

        .more-btn {
            background: none;
            border: 0 none;
            line-height: normal;
            overflow: visible;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            width: 100%;
            text-align: left;
            outline: none;
            cursor: pointer;
        }

        .more-dot {
            background-color: #aab8c2;
            display: inline-block;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            transition: background-color 0.3s;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

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
            <h1 class="d-flex flex-row"><span class="label">Issues</span></h1>
        </div>
        <div class="d-flex flex-row pt-3 w-100 align-items-center justify-content-center gap-3">
            <x-button outline primary label="Create" class="col-1" data-bs-toggle="modal" data-bs-target="#create"/>
        </div>
    </div>
    <div class="d-flex flex-column col-12 align-items-center pb-4 pt-4">
        @if(!empty(auth()->user()->userWorkspace))
            @foreach(auth()->user()->userWorkspace as $workspace)
                @if(!empty($workspace->workspace->projects))
                    @foreach($workspace->workspace->projects as $project)
                        @if(!empty($project->issues))
                            @foreach($project->issues as $issue)
                                <div class="d-flex flex-column col-6 p-3">
                                    <div class="d-flex flex-row w-100 align-items-center justify-content-between gap-3">
                                        <div class="d-flex flex-row align-items-end gap-3">
                                            <div class="d-flex flex-column w-10">
                                                <div class="img-holder">
                                                    {{ $issue->presenter()->initials }}
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column w-50">
                                                <span class="align-items-center" style="font-size: 20px; padding-bottom: 3px">{{ $issue->name }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="container">
                                                <div class="dropdown">
                                                    <button id="more-btn" class="more-btn" aria-haspopup="true" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <span class="more-dot"></span>
                                                        <span class="more-dot"></span>
                                                        <span class="more-dot"></span>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <button class="dropdown-item" type="button">Archive</button>
                                                        <button class="dropdown-item" id="delete" type="button" value="{{$issue->id}}">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                @endif
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
                <form method="POST" action="{{ route("issue_create") }}">
                    <div class="modal-body">
                        @csrf
                        <div class="form d-flex flex-column gap-3">
                            <x-input name="name" label-top error-less placeholder="Name" wrapper-class="w-100"
                                     required/>
                            <select name="project" class="form-select" aria-label="Default select example">
                                <option selected disabled>Select project</option>
                                @if(!empty(auth()->user()->userWorkspace))
                                    @foreach(auth()->user()->userWorkspace as $workspace)
                                        @if(!empty($workspace->workspace->projects))
                                            @foreach($workspace->workspace->projects as $project)
                                                <option
                                                    value="{{$project->id}}">{{$project->name}}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            </select>
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
    <script>
        $('#delete').on('click', function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let id = $(this).attr("value");
            $.ajax({
                url: '{{route('issue_delete')}}',
                type: 'POST',
                data: {
                    'id': id,
                },
                success: function(){
                    location.reload();
                }
            });
        });
    </script>
@endsection
