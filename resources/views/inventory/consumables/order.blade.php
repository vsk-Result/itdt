@extends('layouts.app')

@section('title', 'Заказ расходных материалов')
@section('page-title', 'Заказ расходных материалов')

@section('second_navbar')
    @auth
        @include('inventory.partials._nav')
    @endauth
@endsection

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Заказ расходных материалов</h6>
        </div>
        <div class="card-body">

            {{ Form::open(['url' => route('inventory.orders.store'), 'method' => 'POST']) }}

                <button type="submit" class="btn btn-outline-success mb-3">
                    <i class="icon-cart2 mr-1"></i> Заказать
                </button>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Объект</label>
                            {{ Form::select('object_id', $objects, null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Ответственное лицо</label>
                            {{ Form::text('responsible', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>

                <div class="row">

                    @foreach($printer_models as $model)

                        <div class="col-md-4 mb-3">

                            <h6 class="font-weight-semibold mt-2">{{ $model->name }} <span class="ml-1">({{ $model->consumables->count() }})</span></h6>
                            <div class="dropdown-divider mb-2"></div>

                            @foreach($model->consumables as $consumable)
                                <div class="dropdown-item cursor-default">
                                    <span class="badge badge-mark mr-1" style="border-color: {{ $consumable->getHexColor() }}"></span>
                                    <a target="_blank" href="{{ route('inventory.consumables.show', $consumable) }}">
                                        {{ $consumable->getFullName() }}
                                    </a>
                                    {{ Form::hidden('consumable_ids[]', $consumable->id, ['class' => 'form-control']) }}
                                    {{ Form::text('counts[]', null, ['class' => 'form-control ml-auto w-25 count-field']) }}
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/partials/order.js') }}"></script>
@endpush

@push('css')

@endpush