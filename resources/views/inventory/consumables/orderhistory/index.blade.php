@extends('layouts.app')

@section('title', 'История заказов')
@section('page-title', 'История заказов')

@section('second_navbar')
    @auth
        @include('inventory.partials._nav')
    @endauth
@endsection

@section('content')
<div class="d-flex align-items-start flex-column flex-md-row">

    <div class="w-100 overflow-auto order-2 order-md-1">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title printers-title">Заказы</h5>
            </div>

            <div class="card-body p-0">
                <table class="table printers-list table-lg table-hover">

                    <thead>
                        <tr>
                            <th>
                                <tr>
                                    <td>Ответственное лицо</td>
                                    <td>Пользователь</td>
                                    <td>Объект</td>
                                </tr>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td><a>{{ $order->responsible }}</a></td>
                            <td><a>{{ $order->user->name }}</a></td>
                            <td><a>{{ $order->object->code . '-' . $order->object->name }}</a></td>
                            <td class="text-right">
                                <div class="list-icons-item dropdown">
                                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(16px, 16px, 0px);">
                                            <a class="list-icons-item" href="{{ route('inventory.orderhistory.store', $order) }}"><i class="icon-cart2 mr-1"></i>Скачать заказ</a>

                                            <div class="dropdown-divider"></div>

                                            <a class="list-icons-item" href="{{ route('inventory.orderhistory.destroy', $order) }}"><i class="icon-cross2"></i>Удалить</a></h6>
                                        </div>
                            </td>
                        </tr>
                    @endforeach
                        {{ $orders->links() }}
                    </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
