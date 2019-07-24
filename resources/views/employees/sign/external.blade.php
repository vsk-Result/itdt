@extends('layouts.external_app')

@section('title', 'Новая подпись (' . $companyName . ')')
@section('page-title', 'Новая подпись (' . $companyName . ')')

@section('content')
    <div class="row">
        <div class="col-md-4 mx-md-auto">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">{{  'Новая подпись (' . $companyName . ')' }}</h6>
                </div>
                <div class="card-body">
                    @include('partials.sign_form')
                </div>
            </div>
        </div>
    </div>
@endsection