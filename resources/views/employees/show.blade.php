@extends('layouts.app')

@section('title', 'Сотрудники - ' . $employee->fullname)
@section('page-title', 'Сотрудники - ' . $employee->fullname)

@section('content')
    <div class="d-md-flex align-items-md-start">
        <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-left wmin-300 border-0 shadow-0 sidebar-expand-md">
            <div class="sidebar-content">
                <div class="card">
                    <div class="card-img-actions">
                        <img class="card-img-profile img-fluid" src="{{ $employee->getAvatarUrl() }}" alt="">
                    </div>

                    <div class="card-body text-center">
                        <h6 class="font-weight-semibold mb-0">{{ $employee->fullname }}</h6>
                        <span class="d-block text-muted">{{ $employee->getPostName() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-content w-100">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a href="#profile-tab1" class="nav-link active" data-toggle="tab">Профиль</a></li>
                        @if (Auth::user()->hasPermission('employees') || Auth::user()->employee_id == $employee->id)
                            <li class="nav-item"><a href="#profile-tab2" class="nav-link" data-toggle="tab">Изменение</a></li>
                        @endif
                        <li class="nav-item"><a href="#profile-tab3" class="nav-link" data-toggle="tab">Подпись</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active show" id="profile-tab1">
                            @include('employees.partials.info_tab')
                        </div>
                        @if (Auth::user()->hasPermission('employees') || Auth::user()->employee_id == $employee->id)
                            <div class="tab-pane" id="profile-tab2">
                                @include('employees.partials.edit_tab')
                            </div>
                        @endif
                        <div class="tab-pane" id="profile-tab3">
                            @include('employees.partials.sign_tab')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script>
        $(function() {
            $('.select').select2();
        });
    </script>
@endpush