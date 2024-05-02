@extends('layouts.contentLayoutMaster')

@section('title', 'Issues')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/plugins/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/plugins/datatable/responsive.bootstrap5.min.css')) }}">
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

        .profile-image img {
            margin-left: 3px;
        }
    </style>
@endsection

@section('header')
    <nav class="navbar navbar-page navbar-expand-lg bg-white d-flex flex-row w-100 ps-3 pb-1"
         style="margin: 0; box-shadow: none; border-bottom:  1px solid rgba(0, 0, 0, 0.1); height: 45px">
        <x-button class="toggle-right close" size="sm" monochrome outline
                  iconRight="burger-menu-svgrepo-com"></x-button>

        <div class="container-fluid">

        </div>
    </nav>
@endsection

@section('content')
    <div class="card m-5 mt-4">
        <div class="card-body">
            <span>Issues</span>
            <table id="example" class="display table" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <td>
                        <x-button outline sm primary label="New issue" class="col-1" data-bs-toggle="modal"
                                  data-bs-target="#create"/>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
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
                                @if($workspaces = data_get(auth()->user(), 'userWorkspace'))
                                    @foreach($workspaces as $workspace)
                                        @foreach($workspace->workspace->projects as $project)
                                            <option value="{{$project->id}}">{{$project->name}}</option>
                                        @endforeach
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
    <script src="{{ asset(mix('vendors/js/plugins/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/plugins/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/plugins/datatable/datatables.checkboxes.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/plugins/datatable/dataTables.responsive.min.js')) }}"></script>
@endsection

@section('page-script')
    <script>
        var table = $('.table').dataTable({
            "bPaginate": false,
            "bInfo": false,
            "bFilter": false,
            serverSide: true,
            ajax: {
                async: true,
                url: '{!! route('issue.list') !!}',
                type: "GET",
                dataSrc: function (response) {
                    var $container = $(table.api().table().container());
                    $container.parents('.island').find('.subheader .table-sort-mobile').html(response.sorting);
                    response.recordsTotal = response.total;
                    response.recordsFiltered = response.total;
                    return response.data;
                }
            },
            autoWidth: false,
            columnDefs: [
                {
                    targets: [0],
                    className: 'not-mobile-l none',
                    render: function (data) {
                        if (data === null || data.length === 0) {
                            return '---';
                        } else {
                            return data;
                        }
                    }
                },
            ],
            columns: [
                {data: 'name', width: '250px'},
            ],
            order: [[0, 'asc']],
            dom: 'rt<"datatables-footer d-flex flex-column flex-sm-row align-items-center gap-10px justify-content-between w-100"pl>',
            responsive: {
                breakpoints: [{
                    name: 'mobile-l',
                    width: 576
                }],
            },
        });

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
                success: function () {
                    location.reload();
                }
            });
        });
    </script>
@endsection
