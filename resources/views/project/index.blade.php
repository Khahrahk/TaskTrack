@extends('layouts.contentLayoutMaster')

@section('title', 'Projects')

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
        <x-button class="toggle-right close" size="sm" monochrome outline
                  iconRight="burger-menu-svgrepo-com"></x-button>

        <div class="container-fluid">

        </div>
    </nav>
@endsection

@section('content')
    {{--    <div class="header d-flex flex-column col-lg-12 align-items-center justify-content-center pb-4 pt-4">--}}
    {{--        <div class="d-flex flex-column w-100 align-items-center justify-content-center">--}}
    {{--            <h1 class="d-flex flex-row"><span class="label">Projects</span></h1>--}}
    {{--        </div>--}}
    {{--        <div class="d-flex flex-row pt-3 w-100 align-items-center justify-content-center gap-3">--}}
    {{--            <x-button outline primary label="Create" class="col-1" data-bs-toggle="modal" data-bs-target="#create"/>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <div class="d-flex flex-column col-12 align-items-center pb-4 pt-4">--}}
    {{--        @if(!empty(auth()->user()->userWorkspace))--}}
    {{--            @foreach(auth()->user()->userWorkspace as $workspace)--}}
    {{--                @if(!empty($workspace->workspace->projects))--}}
    {{--                    @foreach($workspace->workspace->projects as $project)--}}
    {{--                        <div class="d-flex flex-column col-6 p-3">--}}
    {{--                            <div class="d-flex flex-row w-100 align-items-center gap-3">--}}
    {{--                                <div class="d-flex flex-column w-10">--}}
    {{--                                    <div class="img-holder">--}}
    {{--                                        {{ $project->presenter()->initials }}--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="d-flex flex-column w-50">--}}
    {{--                                    <span><h1>{{ $project->name }}</h1></span>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    @endforeach--}}
    {{--                @endif--}}
    {{--            @endforeach--}}
    {{--        @endif--}}
    {{--    </div>--}}
    <div class="card m-5 mt-4">
        <div class="card-body">
            <span>Projects</span>
            <table id="example" class="display table" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <td>New list</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
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
                <form method="POST" action="{{ route("project_create") }}">
                    <div class="modal-body">
                        @csrf
                        <div class="form d-flex flex-column gap-3">
                            <x-input name="name" label-top error-less placeholder="Name" wrapper-class="w-100"
                                     required/>
                            <select name="workspace" class="form-select" aria-label="Default select example">
                                <option selected disabled>Select workspace</option>
                                @if(!empty(auth()->user()->userWorkspace))
                                    @foreach(auth()->user()->userWorkspace as $workspace)
                                        <option
                                            value="{{$workspace->workspace->id}}">{{$workspace->workspace->name}}</option>
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
    <script src="https://yastatic.net/jquery/3.3.1/jquery.min.js"></script>
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
            processing: true,
            serverSide: true,
            ajax: {
                async: true,
                // data: function (d) {
                //     d.filter = Object.fromEntries(filtersForm.serializeArray().map(kv => [kv.name, kv.value]));
                // },
                url: '{!! route('project.list') !!}',
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
                    targets: [0, 1, 2, 3, 4, 5, 6],
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
                {data: 'fullName', width: '250px'},
                {data: 'department', width: '300px'},
                {data: 'group', width: '350px'},
                {data: 'team', width: '120px'},
                {data: 'email', width: '150px'},
                {data: 'phone', width: '130px'},
                {data: 'telegram', width: '130px'},
            ],
            order: [[0  , 'asc']],
            dom: 'rt<"datatables-footer d-flex flex-column flex-sm-row align-items-center gap-10px justify-content-between w-100"pl>',
            language: {
                lengthMenu: `<select class="selectpicker w-160px" data-container="body">
                            <option value="10" title="10 на странице">10</option>
                            <option value="20" title="20 на странице">20</option>
                            <option value="30" title="30 на странице">30</option>
                            <option value="40" title="40 на странице">40</option>
                            <option value="50" title="50 на странице">50</option>
                            <option value="100" title="100 на странице">100</option>
                            <option value="250" title="250 на странице">250</option>
                        </select>`,
            },
            drawCallback: function () {
                var container = this.api().table().container(),
                    checkboxAll = $(container).find('th.dt-checkboxes-select-all.dt-checkboxes-cell'),
                    buttonsContainer = $(checkboxAll).parents('.island').find('.multiple-actions .select-all-container');
                checkboxAll.find('.form-check').addClass('d-none');
                checkboxAll.find('label').html('Все');
                buttonsContainer.html(checkboxAll.html());
                buttonsContainer.find('.d-none').removeClass('d-none');
                if (!scroll && $(window).width() > 497) {
                    scroll = new PerfectScrollbar(this.api().table().container());
                }
                updateSize();
                reloadSelects();
            },
            initComplete: function () {
                $('.datatables-footer').appendTo('.island-footer-content');
                $('.selectpicker').selectpicker();
            },
            responsive: {
                breakpoints: [{
                    name: 'mobile-l',
                    width: 576
                }],
                // details: {
                //     display: $.fn.dataTable.Responsive.display.childRowImmediate,
                //     type: 'none',
                //     target: '',
                //     renderer: function (api, rowIdx, columns) {
                //         var [fullName, department, group, team, email, phone, telegram, questions] = $.map(columns, function (col, i) {
                //             return col.data;
                //         });
                //         var str = `<tr class="w-100 d-inline-table"><td>
                //             <div class="shipment-mobile">
                //                 <div class="header">
                //                     <div class="title">
                //                         <div class="name">
                //                             ${fullName}
                //                         </div>
                //                     </div>`;
                //         str += `</div>
                //                 <div class="content">
                //                     <div class="basic-info">`;
                //         if (department !== '' && department !== '---') {
                //             str += `<div class="d-flex flex-column gap-5px">
                //                             <span>Департамент:</span>
                //                             <span>${department}</span>
                //                         </div>`;
                //         }
                //         if (group !== '' && group !== '---') {
                //             str += `<div class="d-flex flex-column gap-5px">
                //                             <span>Отдел:</span>
                //                             <span>${group}</span>
                //                         </div>`;
                //         }
                //         if (team !== '' && team !== '---') {
                //             str += `<div class="d-flex flex-column gap-5px">
                //                             <span>Команда:</span>
                //                             <span>${team}</span>
                //                         </div>`;
                //         }
                //         str += `<button class="l-button align-items-center d-inline-flex justify-content-center size-md type-link color-primary toggle-mod">показать подробности</button>
                //                     </div>
                //                     <div class="extended-info collapse">`;
                //         if (email !== '' && email !== '---') {
                //             str += `<div class="d-flex flex-column gap-5px">
                //                             <span>E-mail:</span>
                //                             <span>${email}</span>
                //                         </div>`;
                //         }
                //         if (phone !== '' && phone !== '---') {
                //             str += `<div class="d-flex flex-column gap-5px">
                //                             <span>Телефон:</span>
                //                             <span>${phone}</span>
                //                         </div>`;
                //         }
                //         if (telegram !== '' && telegram !== '---') {
                //             str += `<div class="d-flex flex-column gap-5px">
                //                             <span>Телеграм:</span>
                //                             <span>${telegram}</span>
                //                         </div>`;
                //         }
                //         str += `</div></div></div></td></tr>`;
                //         return str;
                //     }
                // },
            },
        });
    </script>
@endsection
