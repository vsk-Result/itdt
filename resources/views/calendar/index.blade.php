@extends('layouts.app')

@section('title', 'Календарь')
@section('page-title', 'Календарь')

@section('content')

@include('calendar.defaultModal')

<div id="calendar"
     class="panel panel-primary"
     data-all-url="{{ route('events.all') }}"
     data-create-url="{{ route('events.create') }}"
     data-update-url="{{ route('events.update') }}"
     data-edit-url="{{ route('events.edit') }}"
     data-destroy-url="{{ route('events.destroy') }}"
     data-status-url="{{ route('events.status') }}"
     data-show-url="{{ route('events.show') }}">
</div>

@endsection

@push('scripts')
    <script src="{{ asset('vendors/fullcalendar/lib/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('vendors/fullcalendar/lib/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/fullcalendar/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('vendors/fullcalendar/locale/ru.js') }}"></script>
    <script src="{{ asset('js/partials/calendar.js') }}"></script>
    @endpush

@push('css')
    <link href="{{ asset('vendors/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet">
@endpush
