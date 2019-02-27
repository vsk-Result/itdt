@extends('layouts.app')

@section('title', 'Расходный материал - ' . $consumable->getFullName())
@section('page-title', 'Расходный материал - ' . $consumable->getFullName())

@section('second_navbar')
    @include('inventory.partials._nav')
@endsection

@section('header-elements')
    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a href="#" title="Изменить данные" class="btn btn-sm bg-primary-400 btn-icon rounded-round edit-consumable" data-edit-url="{{ route('inventory.consumables.edit', $consumable) }}" data-update-url="{{ route('inventory.consumables.update', $consumable) }}">
                <i class="icon-pencil5"></i>
            </a>
        </div>
    </div>
@endsection

@section('content')
    @include('inventory.consumables.modals.create_movement')
    @include('inventory.consumables.modals.edit_movement')
    @include('inventory.consumables.modals.create_replacement')
    @include('inventory.consumables.modals.edit_replacement')
    @include('inventory.consumables.modals.edit_consumable')

    <div class="d-flex align-items-start flex-column flex-md-row">

        <div class="w-100 overflow-auto order-2 order-md-1">

            <div class="card">
                <div class="card-body p-0">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a href="#basic-tab1" class="nav-link active" data-toggle="tab">Движения</a></li>
                        <li class="nav-item"><a href="#basic-tab2" class="nav-link" data-toggle="tab">Замены</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="basic-tab1">
                            @include('inventory.consumables.tabs.movements')
                        </div>

                        <div class="tab-pane fade" id="basic-tab2">
                            @include('inventory.consumables.tabs.replacements')
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar sidebar-light bg-transparent sidebar-component sidebar-component-right wmin-md-250 border-0 shadow-0 order-1 order-md-2 sidebar-expand-md">
            <div class="sidebar-content">
                @include('inventory.consumables.blocks.actions')
                @include('inventory.consumables.blocks.general')
                @include('inventory.consumables.blocks.stock')
                @include('inventory.consumables.blocks.compatibility')

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendors/tables/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendors/tables/datatables/extensions/natural_sort.js') }}"></script>
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('js/partials/consumable.js') }}"></script>
@endpush