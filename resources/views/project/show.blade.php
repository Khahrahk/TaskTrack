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

        .feather {
            width: 16px;
            height: 16px;
        }
    </style>
@endsection

@section('header')
    @include('components.nav', $pageSubmenu)
@endsection

@section('content')
    <div class="card m-5 mt-4">
        <div class="card-body">
            <span>Issues</span>
            <div class="table-responsive pt-2">
                <table class="table no-hover no-header-mobile table-fixed" style="width:100%">
                    <thead>
                    <tr>
                        <th>
                            <div class="value">Name</div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="border-0">
                            <x-button outline sm primary label="New issue" data-bs-toggle="modal" data-bs-target="#create-modal"/>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
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
        var table = $('.table').dataTable({
            "bPaginate": false,
            "bInfo": false,
            "bFilter": false,
            "language": {
                "sZeroRecords": "Nothing to show"
            },
            processing: false,
            serverSide: true,
            ajax: {
                async: true,
                url: '{!! route('issues.list') !!}',
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
            order: [],
            dom: 'rt<"datatables-footer d-flex flex-column flex-sm-row align-items-center gap-10px justify-content-between w-100"pl>',
            initComplete: function () {
                let th = $('.table th');
                th.unbind('click');
                th.on('click', function (e) {
                    $(this).blur();
                    var shift = e.shiftKey,
                        order = table.api().order(),
                        colIndex = table.api().column(this).index(),
                        newOrder = [],
                        processed = false;

                    for (var i = 0; i < order.length; i++) {
                        var column = order[i][0],
                            direction = order[i][1];

                        if (column === colIndex) {
                            if (direction === 'asc') {
                                newOrder.push([colIndex, 'desc']);
                                processed = true;
                            } else if (direction === 'desc') {
                                table.api().order([]).draw();
                                processed = true;
                            }
                        } else if (shift) {
                            newOrder.push(order[i]);
                        }
                    }
                    if (!processed) newOrder.push([colIndex, 'asc']);
                    table.api().order(newOrder).draw();
                });
            },
            responsive: {
                breakpoints: [{
                    name: 'mobile-l',
                    width: 576
                }],
            },
        });

        var updateModal = $('.modal#update-modal');
        var createModal = $('.modal#create-modal');

        createModal.on('shown.bs.modal', function (e) {
            $(e.currentTarget).find('#submit').prop('disabled', false);
            $(this).find('input[autofocus]').focus();
        })

        createModal.on('hidden.bs.modal', function (e) {
            $(e.currentTarget).find('#submit').prop('disabled', true);
        })

        createModal.on('submit', 'form', function (e) {
            e.preventDefault();
            var form = $(this);
            let dangerLabel = $('#danger-label-create');
            var formData = new FormData(form[0]);
            $.ajax({
                type: 'POST',
                url: '{!! route('issues.store') !!}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: () => {
                    table.api().ajax.reload();
                    createModal.modal('toggle');
                    if(dangerLabel.length > 0){
                        dangerLabel.remove();
                        $('.has-error').removeClass("has-error");
                    }
                    setTimeout(() => {
                        form.trigger('reset');
                    }, 300);
                },
                error: response => {
                    if(dangerLabel.length > 0) {
                        dangerLabel.remove();
                        $('.has-error').removeClass("has-error");
                    }
                    $.each(response.responseJSON.errors, function (key, value) {
                        var input = form.find(`input[name=${key}]`),
                            inputContainer = input.parent().parent(),
                            errorContainer = inputContainer.find('label.text-danger-500');
                        var svg = feather.icons['x'].toSvg({class: 'icon-wrapper', height: 10})
                        if (errorContainer.length) {
                            errorContainer.html(svg + value[0]);
                        } else {
                            inputContainer.append(`<label class="text-danger" id='danger-label-create' for="${input.attr('id')}">${svg} ${value[0]}</label>`);
                        }
                        input.addClass('has-error');
                    });
                },
            });
        });

        updateModal.on('shown.bs.modal', function (e) {
            $(e.currentTarget).find('input[name="id"]').val($(e.relatedTarget).data('id'));
            $(e.currentTarget).find('input[name="name"]').val($(e.relatedTarget).data('name'));
            $(e.currentTarget).find('#submit').prop('disabled', false);
            $(e.currentTarget).find('#delete').prop('disabled', false);
            $(this).find('input[autofocus]').focus();
        })

        updateModal.on('hidden.bs.modal', function (e) {
            $(e.currentTarget).find('#submit').prop('disabled', true);
            $(e.currentTarget).find('#delete').prop('disabled', true);
        })

        updateModal.on('submit', 'form', function (e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            $.ajax({
                type: 'POST',
                url: '{!! route('issues.update') !!}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: () => {
                    table.api().ajax.reload();
                    updateModal.modal('toggle');
                    setTimeout(() => {
                        form.trigger('reset');
                    }, 300);
                },
                error: response => {
                    $.each(response.responseJSON.errors, function (key, value) {
                        var input = form.find(`input[name=${key}]`),
                            inputContainer = input.parent().parent(),
                            errorContainer = inputContainer.find('label.text-danger-500');
                        var svg = feather.icons['x'].toSvg({class: 'icon-wrapper'})
                        if (errorContainer.length) {
                            errorContainer.html(svg + value[0]);
                        } else {
                            inputContainer.append(`<label class="text-danger" for="${input.attr('id')}">${svg} ${value[0]}</label>`);
                        }
                        input.addClass('has-error');
                    });
                },
            });
        });

        updateModal.find('#delete').on('click', function () {
            var form = updateModal.find('#form');
            var formData = new FormData(form[0]);
            $.ajax({
                type: 'POST',
                url: '{!! route('issues.delete') !!}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: () => {
                    table.api().ajax.reload();
                    updateModal.modal('toggle');
                    setTimeout(() => {
                        form.trigger('reset');
                    }, 300);
                },
            });
        });
    </script>
@endsection
