@extends('layouts.app')

@section('title', 'Объекты')
@section('page-title', 'Объекты')

@section('content')
    @foreach($objects->chunk(6) as $chunk_objects)
        <div class="row">
            @each('objects.partials.object_card', $chunk_objects, 'object')
        </div>
    @endforeach
@endsection