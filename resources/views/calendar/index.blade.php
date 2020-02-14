@extends('layouts.app')

@section('title', 'Календарь')
@section('page-title', 'Календарь')

@section('content')

@include('calendar.defaultModal')

<div id="calendar" class="panel panel-primary">
</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/fullcalendar/lib/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/lib/moment.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('js/fullcalendar/locale/ru.js') }}"></script>
    <script src="{{ asset('js/partials/calendar.js') }}"></script>
    @endpush

@push('css')
    <link href="{{ asset('js/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet">
@endpush
