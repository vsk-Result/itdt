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
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Актуальные статьи</h6>
        </div>

        <div class="card-body">
            <div class="row">
                @each('knowledge.partials.category', $categories, 'category')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendors/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('vendors/tags/tokenfield.min.js') }}"></script>
    <script src="{{ asset('js/partials/knowledge.js') }}"></script>
@endpush

@push('css')
    <link href="{{ asset('vendors/summernote/summernote.css') }}" rel="stylesheet">
    <style>
        .card-body .dropdown-toggle::after {
            content: ''
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
    </style>
@endpush