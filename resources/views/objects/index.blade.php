@extends('layouts.app')

@section('title', 'Объекты')
@section('page-title', 'Объекты')

@section('header-elements')
    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a href="{{ route('objects.create') }}" title="Добавить задачу" class="btn btn-sm bg-success-400 btn-icon rounded-round">
                <i class="icon-plus2"></i>
            </a>
        </div>
    </div>
@endsection

@section('content')

    <div id="filter-bar" class="navbar navbar-expand-lg navbar-light navbar-component rounded py-2">
        <div class="text-center d-lg-none w-100">
            <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-filter">
                <i class="icon-unfold mr-2"></i>
                Фильтры
            </button>
        </div>

        <div class="navbar-collapse collapse" id="navbar-filter">
            <div class="form-check form-check-switchery form-check-switchery-double form-check-switchery mb-3 mb-lg-0">
                <label class="form-check-label">
                    Активные
                    <input id="objects-active" type="checkbox" class="form-check-input-switchery" data-fouc>
                    Все
                </label>
            </div>
        </div>
    </div>

    <div id="objects-container" data-url="{{ route('objects.all') }}"></div>
@endsection

@push('css')
    <style>
        .card-body .card-title, .card-body .card-text {
            min-height: 52px;
            margin-bottom: 0;
        }
        .card-body .card-text {
            margin-top: 8px;
        }
        .card-body {
            padding-bottom: 0;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('vendors/styling/switchery.min.js') }}"></script>
    <script src="{{ asset('js/partials/objects.js') }}"></script>
@endpush