@extends('layouts.contentLayoutMaster')

@section('title', 'Issues')
@section('page-style')
    <style rel="stylesheet" href="{{ asset(mix('css/pages/issue/board.css')) }}"></style>
@endsection

@section('header')
    @include('components.nav', $pageSubmenu)
@endsection

@section('content')
    <div class="d-flex flex-row board w-100 p-5">
        <div class="d-flex flex-row lanes w-100 gap-5">
            @foreach($statuses as $status)
                <div class="status d-flex flex-column swim-lane h-100 border border-1 rounded-1 p-2 gap-2" id="todo-lane" data-id="{{ $status->id }}" data-csrf="{{ csrf_token() }}" style="min-width: 200px">
                    <span class="p-2 mb-2" style="font-weight: 550">{{ $status->name }}</span>
                    @foreach($status->issues->sortBy('order_position') as $issue)
                        <div class="task d-flex flex-column border border-1 rounded-1 p-2 pt-1 gap-2"
                             draggable="true" data-id="{{ $issue->id }}" data-name="{{ $issue->name }}"
                             style="min-height: 100px" data-bs-toggle="modal" data-bs-target="#update-modal">
                            <div class="d-flex flex-row">
                                <span class="project-name">{{ $issue->project->name }}</span>
                            </div>
                            <div class="d-flex flex-row">
                                <span class="issue-name">{{ $issue->name }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    @include('issue.components.modal-create')
    @include('issue.components.modal-update')
@endsection
@section('page-script')
    <script src="{{ asset(mix('js/pages/issue/board.js')) }}" defer></script>
@endsection
