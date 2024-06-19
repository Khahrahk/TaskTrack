@extends('layouts.contentLayoutMaster')

@section('title', 'Issues')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/plugins/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/plugins/datatable/responsive.bootstrap5.min.css')) }}">
@endsection

@section('page-style')
    <script src="{{asset(mix('js/pages/issues/board.js'))}}" defer></script>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: sans-serif;

            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        *::-webkit-scrollbar {
            display: none;
        }

        .board {
            overflow: scroll;
            background-position: center;
            background-size: cover;
        }

        #todo-form input {
            border-radius: 4px;
            border: 1px solid black;
            background: white;
            font-size: 14px;
            outline: none;
        }

        #todo-form button {
            border-radius: 4px;
            border: 1px solid black;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
        }

        .lanes {
            display: flex;
            align-items: flex-start;
            justify-content: start;
            overflow: scroll;
            height: 100%;
        }

        .heading {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .swim-lane {
            display: flex;
            flex-direction: column;
            gap: 12px;
            flex: 1 1 0;
            padding: 12px;
            border-radius: 4px;
        }

        .task {
            background: white;
            color: black;
            border: 1px solid black;
            padding: 12px;
            border-radius: 4px;

            font-size: 16px;
            cursor: move;
        }

        .task .issue-name {
            font-size: 14px;
        }

        .task .project-name {
            font-size: 11px;
        }

        .is-dragging {
            scale: 1.05;
            color: white;
        }
    </style>
@endsection

@section('header')
    <div class="d-flex flex-column w-100">
        <nav class="d-flex flex-row navbar navbar-page navbar-expand-lg bg-white w-100 ps-3 pb-1"
             style="margin: 0; box-shadow: none; border-bottom:  1px solid rgba(0, 0, 0, 0.1); height: 45px">
            <x-button class="toggle-right close" size="sm" monochrome outline
                      iconRight="burger-menu-svgrepo-com"></x-button>

            <div class="container-fluid">

            </div>
        </nav>
        <nav class="d-flex flex-row bg-white w-100 ps-3 p-2 submenu"
             style="margin: 0; box-shadow: none; border-bottom:  1px solid rgba(0, 0, 0, 0.1); height: 45px">
            @isset($pageSubmenu)
                <div class="d-flex flex-row actions gap-1">
                    @foreach($pageSubmenu as $page)
                        <a class="d-flex flex-column px-4 p-1 {{Request::routeIs($page['link']) ? 'active' : ''}}"
                           href="{{ route($page['link']) }}">
                            <div>
                                {{$page['name']}}
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="container-fluid">

                </div>
            @endif
        </nav>
    </div>
@endsection

@section('content')
    <div class="d-flex flex-row board w-100 p-5">
        <div class="d-flex flex-row lanes justify-content-between w-100 gap-5">
            <div id="app">
                <issue v-bind:statuses="{{ json_encode($statuses) }}"></issue>
            </div>
{{--            @foreach($statuses as $status)--}}
{{--                <div class="status d-flex flex-column swim-lane h-100" id="todo-lane" data-id="{{ $status->id }}" data-csrf="{{ csrf_token() }}">--}}
{{--                    <span class="border border-1 rounded-1 p-2 mb-5" style="font-weight: 550">{{ $status->name }}</span>--}}
{{--                    @foreach($status->issues as $issue)--}}
{{--                        <div class="task d-flex flex-column border border-1 rounded-1 p-2 pt-1 gap-2"--}}
{{--                             draggable="true" data-id="{{ $issue->id }}" data-name="{{ $issue->name }}"--}}
{{--                             style="min-height: 100px">--}}
{{--                            <div class="d-flex flex-row">--}}
{{--                                <span class="project-name">{{ $issue->project->name }}</span>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex flex-row">--}}
{{--                                <span class="issue-name">{{ $issue->name }}</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            @endforeach--}}
        </div>
    </div>
    <div class="modal fade" id="create-modal" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel"
         data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create issue</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="w-100" id="form" method="post" action="">
                    <div class="modal-body">
                        @csrf
                        <x-input id="name" name="name" wrapper-class="w-100" label-top label="Name:"
                                 autofocus required/>
                        <div class="modal-footer p-0 mt-2" style="border-top: none">
                            <div class="d-flex justify-content-end gap-2">
                                <x-button outline monochrome data-bs-dismiss="modal" label="Cancel"/>
                                <x-button primary disabled id="submit" type="submit" label="Create"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="update-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update issue</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="w-100" id="form" method="post" action="">
                    <div class="modal-body">
                        @csrf
                        <x-input type="hidden" id="id" name="id"/>
                        <x-input id="name" name="name" wrapper-class="w-100" class="" label-top label="Name:"
                                 autofocus required/>
                        <div class="modal-footer p-0 mt-2" style="border-top: none">
                            <div class="d-flex w-100 justify-content-between">
                                <x-button danger disabled id="delete" label="Delete"/>
                                <div class="d-flex justify-content-end gap-2">
                                    <x-button outline monochrome data-bs-dismiss="modal" label="Cancel"/>
                                    <x-button primary disabled id="submit" type="submit" label="Update"/>
                                </div>
                            </div>
                        </div>
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
        {{--        var table = $('.table').dataTable({--}}
        {{--            "bPaginate": false,--}}
        {{--            "bInfo": false,--}}
        {{--            "bFilter": false,--}}
        {{--            "language": {--}}
        {{--                "sZeroRecords": "Nothing to show"--}}
        {{--            },--}}
        {{--            processing: false,--}}
        {{--            serverSide: true,--}}
        {{--            ajax: {--}}
        {{--                async: true,--}}
        {{--                url: '{!! route('issues.list') !!}',--}}
        {{--                type: "GET",--}}
        {{--                dataSrc: function (response) {--}}
        {{--                    var $container = $(table.api().table().container());--}}
        {{--                    $container.parents('.island').find('.subheader .table-sort-mobile').html(response.sorting);--}}
        {{--                    response.recordsTotal = response.total;--}}
        {{--                    response.recordsFiltered = response.total;--}}
        {{--                    return response.data;--}}
        {{--                }--}}
        {{--            },--}}
        {{--            autoWidth: false,--}}
        {{--            columnDefs: [--}}
        {{--                {--}}
        {{--                    targets: [0],--}}
        {{--                    className: 'not-mobile-l none',--}}
        {{--                    render: function (data) {--}}
        {{--                        if (data === null || data.length === 0) {--}}
        {{--                            return '---';--}}
        {{--                        } else {--}}
        {{--                            return data;--}}
        {{--                        }--}}
        {{--                    }--}}
        {{--                },--}}
        {{--            ],--}}
        {{--            columns: [--}}
        {{--                {data: 'name', width: '250px'},--}}
        {{--            ],--}}
        {{--            order: [],--}}
        {{--            dom: 'rt<"datatables-footer d-flex flex-column flex-sm-row align-items-center gap-10px justify-content-between w-100"pl>',--}}
        {{--            initComplete: function () {--}}
        {{--                let th = $('.table th');--}}
        {{--                th.unbind('click');--}}
        {{--                th.on('click', function (e) {--}}
        {{--                    $(this).blur();--}}
        {{--                    var shift = e.shiftKey,--}}
        {{--                        order = table.api().order(),--}}
        {{--                        colIndex = table.api().column(this).index(),--}}
        {{--                        newOrder = [],--}}
        {{--                        processed = false;--}}

        {{--                    for (var i = 0; i < order.length; i++) {--}}
        {{--                        var column = order[i][0],--}}
        {{--                            direction = order[i][1];--}}

        {{--                        if (column === colIndex) {--}}
        {{--                            if (direction === 'asc') {--}}
        {{--                                newOrder.push([colIndex, 'desc']);--}}
        {{--                                processed = true;--}}
        {{--                            } else if (direction === 'desc') {--}}
        {{--                                table.api().order([]).draw();--}}
        {{--                                processed = true;--}}
        {{--                            }--}}
        {{--                        } else if (shift) {--}}
        {{--                            newOrder.push(order[i]);--}}
        {{--                        }--}}
        {{--                    }--}}
        {{--                    if (!processed) newOrder.push([colIndex, 'asc']);--}}
        {{--                    table.api().order(newOrder).draw();--}}
        {{--                });--}}
        {{--            },--}}
        {{--            responsive: {--}}
        {{--                breakpoints: [{--}}
        {{--                    name: 'mobile-l',--}}
        {{--                    width: 576--}}
        {{--                }],--}}
        {{--            },--}}
        {{--        });--}}

        {{--        var updateModal = $('.modal#update-modal');--}}
        {{--        var createModal = $('.modal#create-modal');--}}

        {{--        createModal.on('shown.bs.modal', function (e) {--}}
        {{--            $(e.currentTarget).find('#submit').prop('disabled', false);--}}
        {{--            $(this).find('input[autofocus]').focus();--}}
        {{--        })--}}

        {{--        createModal.on('hidden.bs.modal', function (e) {--}}
        {{--            $(e.currentTarget).find('#submit').prop('disabled', true);--}}
        {{--        })--}}

        {{--        createModal.on('submit', 'form', function (e) {--}}
        {{--            e.preventDefault();--}}
        {{--            var form = $(this);--}}
        {{--            let dangerLabel = $('#danger-label-create');--}}
        {{--            var formData = new FormData(form[0]);--}}
        {{--            $.ajax({--}}
        {{--                type: 'POST',--}}
        {{--                url: '{!! route('issues.store') !!}',--}}
        {{--                data: formData,--}}
        {{--                cache: false,--}}
        {{--                contentType: false,--}}
        {{--                processData: false,--}}
        {{--                success: () => {--}}
        {{--                    table.api().ajax.reload();--}}
        {{--                    createModal.modal('toggle');--}}
        {{--                    if(dangerLabel.length > 0){--}}
        {{--                        dangerLabel.remove();--}}
        {{--                        $('.has-error').removeClass("has-error");--}}
        {{--                    }--}}
        {{--                    setTimeout(() => {--}}
        {{--                        form.trigger('reset');--}}
        {{--                    }, 300);--}}
        {{--                },--}}
        {{--                error: response => {--}}
        {{--                    if(dangerLabel.length > 0) {--}}
        {{--                        dangerLabel.remove();--}}
        {{--                        $('.has-error').removeClass("has-error");--}}
        {{--                    }--}}
        {{--                    $.each(response.responseJSON.errors, function (key, value) {--}}
        {{--                        var input = form.find(`input[name=${key}]`),--}}
        {{--                            inputContainer = input.parent().parent(),--}}
        {{--                            errorContainer = inputContainer.find('label.text-danger-500');--}}
        {{--                        var svg = feather.icons['x'].toSvg({class: 'icon-wrapper', height: 10})--}}
        {{--                        if (errorContainer.length) {--}}
        {{--                            errorContainer.html(svg + value[0]);--}}
        {{--                        } else {--}}
        {{--                            inputContainer.append(`<label class="text-danger" id='danger-label-create' for="${input.attr('id')}">${svg} ${value[0]}</label>`);--}}
        {{--                        }--}}
        {{--                        input.addClass('has-error');--}}
        {{--                    });--}}
        {{--                },--}}
        {{--            });--}}
        {{--        });--}}

        {{--        updateModal.on('shown.bs.modal', function (e) {--}}
        {{--            $(e.currentTarget).find('input[name="id"]').val($(e.relatedTarget).data('id'));--}}
        {{--            $(e.currentTarget).find('input[name="name"]').val($(e.relatedTarget).data('name'));--}}
        {{--            $(e.currentTarget).find('#submit').prop('disabled', false);--}}
        {{--            $(e.currentTarget).find('#delete').prop('disabled', false);--}}
        {{--            $(this).find('input[autofocus]').focus();--}}
        {{--        })--}}

        {{--        updateModal.on('hidden.bs.modal', function (e) {--}}
        {{--            $(e.currentTarget).find('#submit').prop('disabled', true);--}}
        {{--            $(e.currentTarget).find('#delete').prop('disabled', true);--}}
        {{--        })--}}

        {{--        updateModal.on('submit', 'form', function (e) {--}}
        {{--            e.preventDefault();--}}
        {{--            var form = $(this);--}}
        {{--            var formData = new FormData(form[0]);--}}
        {{--            $.ajax({--}}
        {{--                type: 'POST',--}}
        {{--                url: '{!! route('issues.update') !!}',--}}
        {{--                data: formData,--}}
        {{--                cache: false,--}}
        {{--                contentType: false,--}}
        {{--                processData: false,--}}
        {{--                success: () => {--}}
        {{--                    table.api().ajax.reload();--}}
        {{--                    updateModal.modal('toggle');--}}
        {{--                    setTimeout(() => {--}}
        {{--                        form.trigger('reset');--}}
        {{--                    }, 300);--}}
        {{--                },--}}
        {{--                error: response => {--}}
        {{--                    $.each(response.responseJSON.errors, function (key, value) {--}}
        {{--                        var input = form.find(`input[name=${key}]`),--}}
        {{--                            inputContainer = input.parent().parent(),--}}
        {{--                            errorContainer = inputContainer.find('label.text-danger-500');--}}
        {{--                        var svg = feather.icons['x'].toSvg({class: 'icon-wrapper'})--}}
        {{--                        if (errorContainer.length) {--}}
        {{--                            errorContainer.html(svg + value[0]);--}}
        {{--                        } else {--}}
        {{--                            inputContainer.append(`<label class="text-danger" for="${input.attr('id')}">${svg} ${value[0]}</label>`);--}}
        {{--                        }--}}
        {{--                        input.addClass('has-error');--}}
        {{--                    });--}}
        {{--                },--}}
        {{--            });--}}
        {{--        });--}}

        {{--        updateModal.find('#delete').on('click', function () {--}}
        {{--            var form = updateModal.find('#form');--}}
        {{--            var formData = new FormData(form[0]);--}}
        {{--            $.ajax({--}}
        {{--                type: 'POST',--}}
        {{--                url: '{!! route('issues.delete') !!}',--}}
        {{--                data: formData,--}}
        {{--                cache: false,--}}
        {{--                contentType: false,--}}
        {{--                processData: false,--}}
        {{--                success: () => {--}}
        {{--                    table.api().ajax.reload();--}}
        {{--                    updateModal.modal('toggle');--}}
        {{--                    setTimeout(() => {--}}
        {{--                        form.trigger('reset');--}}
        {{--                    }, 300);--}}
        {{--                },--}}
        {{--            });--}}
        {{--        });--}}
    </script>
@endsection
