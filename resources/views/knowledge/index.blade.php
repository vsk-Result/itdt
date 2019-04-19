@extends('layouts.app')

@section('title', 'База знаний')
@section('page-title', 'База знаний')

@section('header-elements')

@endsection

@section('content')
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
    <script src="{{ asset('js/partials/knowledge.js') }}"></script>
@endpush

@push('css')

@endpush