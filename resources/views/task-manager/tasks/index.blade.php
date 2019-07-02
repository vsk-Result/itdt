@extends('layouts.app')

@section('title', 'Менеджер задач')
@section('page-title', 'Менеджер задач')

@section('header-elements')
    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a id="tasks-store" href="#" title="Добавить задачу" class="btn btn-sm bg-success-400 btn-icon rounded-round" data-store-url="{{ route('tasks.store') }}">
                <i class="icon-plus2"></i>
            </a>
            <a id="tasks-update" href="#" title="Обновить данные" class="btn btn-sm bg-primary-400 btn-icon rounded-round ml-2">
                <i class="icon-spinner9"></i>
            </a>
        </div>
    </div>
@endsection

@section('content')

    @include('task-manager.modals.task_info')
    @include('task-manager.tasks.partials.filter_bar')

    <div id="tasks-container" class="card" data-all-url="{{ route('tasks.all') }}">
        <div class="card-body p-0"></div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendors/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendors/tables/datatables/extensions/natural_sort.js') }}"></script>
    <script src="{{ asset('vendors/tinymce/jquery.tinymce.min.js') }}"></script>
    <script src="{{ asset('vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendors/styling/uniform.min.js') }}"></script>
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendors/notifications/pnotify.min.js') }}"></script>
    <script src="{{ asset('vendors/styling/switchery.min.js') }}"></script>
    <script src="{{ asset('js/partials/task-manager.js') }}"></script>
@endpush

@push('css')
    <style>
        .tox .tox-toolbar__group {
            padding: 0 3px !important;
        }
    </style>
@endpush
