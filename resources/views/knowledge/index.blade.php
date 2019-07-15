@extends('layouts.app')

@section('title', 'База знаний')
@section('page-title', 'База знаний')

@section('header-elements')
    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a href="#" class="btn btn-link btn-float text-primary" data-toggle="modal" data-target="#createArticle"><i class="icon-plus-circle2 text-success"></i><span>Статья</span></a>
        </div>
        <div class="d-flex justify-content-center">
            <a href="#" class="btn btn-link btn-float text-primary" data-toggle="modal" data-target="#createCategory"><i class="icon-plus-circle2 text-success"></i><span>Категория</span></a>
        </div>
    </div>
@endsection

@section('content')

    @include('knowledge.modals.create_article')
    @include('knowledge.modals.show_article')
    @include('knowledge.modals.edit_article')
    @include('knowledge.modals.create_category')
    @include('knowledge.modals.edit_category')
    @include('knowledge.partials.icon_list')

    <div class="card">
        <div class="card-body">
            <div class="input-group">
                <span class="input-group-prepend">
                    <span class="input-group-text"><i class="icon-search4 text-muted"></i></span>
                </span>
                {{ Form::text('filter_tags', null, ['id' => 'filter-input', 'class' => 'form-control form-control-lg alpha-grey', 'placeholder' => 'Поиск по тегам', 'data-url' => route('knowledge.filter')]) }}

                <div class="input-group-append">
                    <button id="filter-category" type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">Категория</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a data-id="all" href="javascript:void(0)" class="dropdown-item active">Все</a>
                        @foreach($categories as $category)
                            <a data-id="{{ $category->id }}" href="javascript:void(0)" class="dropdown-item">
                                <i class="{{ $category->icon->name }}"></i>
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                {{--<span class="input-group-append">--}}
                    {{--<span class="input-group-text">--}}
                        {{--<input type="checkbox" class="form-control-switchery" checked data-fouc>--}}
                    {{--</span>--}}
                {{--</span>--}}
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Актуальные статьи</h6>
        </div>

        <div id="articles-container" class="card-body"></div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendors/tinymce/jquery.tinymce.min.js') }}"></script>
    <script src="{{ asset('vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendors/tags/tokenfield.min.js') }}"></script>
    <script src="{{ asset('vendors/print/dist/jQuery.print.min.js') }}"></script>
    <script src="{{ asset('vendors/styling/uniform.min.js') }}"></script>
    <script src="{{ asset('vendors/styling/switchery.min.js') }}"></script>
    <script src="{{ asset('js/partials/knowledge.js') }}"></script>
@endpush

@push('css')
    <style>
        a.article {
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            width: 100%;
            display: block;
        }
        .card-body .dropdown-toggle::after {
            /*content: ''*/
        }
        .border-top-1 {
            border-top: 1px solid #ccc;
        }
        .no-gutters {
            margin-left: -3px;
        }
        .glyphs>div>div {
            padding: .5rem .5rem;
        }
        #showArticle .close {
            padding-top: .4125rem !important;
        }
        @media (max-width: 992px) {
            #showArticle .modal-content img {
                width: 100% !important;
            }
        }
        .tokenfield .token-input {
             width: 100% !important;
        }
    </style>
@endpush