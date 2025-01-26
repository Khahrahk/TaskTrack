@extends('layouts.contentLayoutMaster')

@section('title', 'Issues')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/plugins/datatable/dataTables.bootstrap5.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/plugins/datatable/responsive.bootstrap5.min.css')) }}">
@endsection

@section('page-style')
    <style rel="stylesheet" href="{{ asset(mix('css/pages/issue/index.css')) }}"></style>
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

    @include('issue.components.modal-create')
    @include('issue.components.modal-update')
@endsection

@section('vendor-script')
    <script src="{{ asset(mix('vendors/js/plugins/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/plugins/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/plugins/datatable/datatables.checkboxes.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/plugins/datatable/dataTables.responsive.min.js')) }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset(mix('js/pages/issue/index.js')) }}" defer></script>
@endsection
