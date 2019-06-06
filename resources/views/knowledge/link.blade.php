@extends('layouts.external_app')

@section('title', $article->title)
@section('page-title', $article->title)

@section('content')
    <h2>{{ $article->title }}</h2>
    <hr>
    {!! $article->content !!}
@endsection

@push('css')
    <link href="{{ asset('vendors/summernote/summernote.css') }}" rel="stylesheet">
    <style>
        /*img {*/
            /*width: 100% !important;*/
        /*}*/
        @media (max-width: 992px) {
            img {
                width: 100% !important;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(function() {
            $('img').each(function() {
                let img = $(this);
                let src = img.attr('src');
                img.attr('src', '/' + src);
            });
            $('a').each(function() {
                let link = $(this);
                let href = link.attr('href');
                link.attr('href', '/' + href);
            });
        });
    </script>
@endpush