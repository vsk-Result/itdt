@extends('layouts.app')

@section('title', 'Принтеры/Расходные материалы')
@section('page-title', 'Принтеры/Расходные материалы')

@section('second_navbar')
    @include('inventory.partials._nav')
@endsection

@section('header-elements')
    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a href="#" class="btn btn-link btn-float text-primary" data-toggle="modal" data-target="#createConsumable"><i class="icon-plus-circle2 text-success"></i><span>Расходник</span></a>
            <a href="#" class="btn btn-link btn-float text-primary" data-toggle="modal" data-target="#createPrinter"><i class="icon-plus-circle2 text-success"></i> <span>Принтер</span></a>
            <a href="#" class="btn btn-link btn-float text-primary" data-toggle="modal" data-target="#createPrinterModel"><i class="icon-plus-circle2 text-success"></i> <span>Модель принтера</span></a>
        </div>
    </div>
@endsection

@section('content')
    @include('inventory.consumables.modals.create_consumable')
    @include('inventory.consumables.modals.edit_consumable')
    @include('inventory.printers.modals.create_printer')
    @include('inventory.printers.modals.edit_printer')
    @include('inventory.printers.modals.create_printer_model')
    @include('inventory.printers.modals.edit_printer_model')

    <div class="d-flex align-items-start flex-column flex-md-row">

        <div class="w-100 overflow-auto order-2 order-md-1">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <h5 class="card-title printers-title">Список принтеров</h5>
                </div>

                <div class="card-body p-0">
                    <table class="table printers-list table-lg table-hover">
                        <thead>
                            <tr>
                                <th>Модель</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($printer_models as $model)

                                <tr data-id="{{ $model->id }}"
                                    data-printers-url="{{ route('inventory.printers.index') }}"
                                    data-consumables-url="{{ route('inventory.consumables.index') }}">

                                    <td>{{ $model->name }}</td>
                                    <td class="text-right">
                                        <div class="list-icons-item dropdown">
                                            <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(16px, 16px, 0px);">

                                                <a href="javascript:void(0)" class="dropdown-item text-primary edit-printer-model" data-edit-url="{{ route('inventory.printer_models.edit', $model->id) }}" data-update-url="{{ route('inventory.printer_models.update', $model->id) }}"><i class="icon-pencil7"></i> Изменить</a>

                                                <div class="dropdown-divider"></div>

                                                <form id="destroy-printer-model-form-{{ $model->id }}" method="POST" action="{{ route('inventory.printer_models.destroy', $model->id) }}" class="mr-1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="javascript:void(0)" class="dropdown-item text-danger-800 destroy-printer-model" data-id="{{ $model->id }}"><i class="icon-cross2"></i> Удалить</a>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right wmin-350 border-0 shadow-0 order-1 order-md-2 sidebar-expand-md">
            <div class="card">
                <div class="card-header bg-transparent header-elements-inline">
                    <span class="text-uppercase font-size-sm font-weight-semibold">Реальные модели</span>
                </div>

                <div id="printers-list" class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            Выберите принтер
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-transparent header-elements-inline">
                    <span class="text-uppercase font-size-sm font-weight-semibold">Расходные материалы</span>
                </div>

                <div id="consumables-list" class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            Выберите принтер
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/partials/printers.js') }}"></script>
    <script src="{{ asset('js/partials/consumable.js') }}"></script>
@endpush

@push('css')
    <style>
        .printers-list tbody tr:hover, .printers-list tbody tr.active{
            background-color: #eaf5ea !important;
            cursor: pointer;
        }
    </style>
@endpush