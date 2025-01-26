@extends('layouts.contentLayoutMaster')

@section('title', 'Projects')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/plugins/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/plugins/datatable/responsive.bootstrap5.min.css')) }}">
@endsection

@section('page-style')
    <style rel="stylesheet" href="{{ asset(mix('css/pages/project/index.css')) }}"></style>
@endsection

@section('header')
    @include('components.nav', $pageSubmenu)
@endsection

@section('content')
    <div class="card m-5 mt-4">
        <div class="card-body">
            <span>Projects</span>
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
                            <x-button outline sm primary label="New project" data-bs-toggle="modal" data-bs-target="#create-modal"/>
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create project</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="w-100" id="form" method="post" action="">
                    <div class="modal-body">
                        @csrf
                        <x-input id="name" name="name" wrapper-class="w-100" label-top label="Name:" autofocus required/>
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update project</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="w-100" id="form" method="post" action="">
                    <div class="modal-body">
                        @csrf
                        <x-input type="hidden" id="id" name="id"/>
                        <x-input id="name" name="name" wrapper-class="w-100" class="" label-top label="Name:" autofocus required/>
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
    <script src="{{ asset(mix('js/pages/project/index.js')) }}" defer></script>
@endsection
