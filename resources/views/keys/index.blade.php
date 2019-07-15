@extends('layouts.app')

@section('title', 'Лицензии')
@section('page-title', 'Лицензии')

@section('header-elements')
    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a id="store-key" href="#" title="Добавить ключ" class="btn btn-sm bg-success-400 btn-icon rounded-round">
                <i class="icon-plus2"></i>
            </a>
        </div>
    </div>
@endsection

@section('content')

    @include('keys.modals.create_key')
    @include('keys.modals.edit_key')

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
                    <input id="keys-active" type="checkbox" class="form-check-input-switchery" data-fouc>
                    Все
                </label>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body" id="keys-container" data-url="{{ route('keys.show') }}"></div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendors/styling/switchery.min.js') }}"></script>
    <script src="{{ asset('js/partials/keys.js') }}"></script>
@endpush

@push('css')
    <style>
        #progressBar {
            margin: auto;
            width:  100%;
            text-align: center;
            background-color: #eee;
            border-radius: .1875rem;
            box-shadow: inset 0 0.0625rem 0.0625rem rgba(0, 0, 0, .1);
        }
        #progressText {
            display: block;
            width: 100%;
            font-weight: bold;
            background: rgba(0, 0, 0, 0.7);
            -webkit-background-clip: text;
            color: transparent;
            font-size: .60938rem;
        }
        #keys tbody {
            font-size: .6125rem;
        }
        #keys tbody td {
            padding: .5rem 0.25rem;
            text-align: center;
        }
        #keys tr.active {
            background-color: #ddd;
        }
    </style>
@endpush