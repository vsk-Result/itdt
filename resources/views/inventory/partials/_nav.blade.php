<div class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-second">
            <i class="icon-unfold mr-2"></i>
            Меню
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-second">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{ route('inventory.consumables.index') }}" class="navbar-nav-link">
                    <i class="icon-cabinet mr-2"></i>
                    Расходники
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('inventory.orders.index') }}" class="navbar-nav-link">
                    <i class="icon-cart5 mr-2"></i>
                    Заказ материалов
                </a>
            </li>
            {{--<li class="nav-item">--}}
                {{--<a href="#" class="navbar-nav-link">--}}
                    {{--<i class="icon-file-excel mr-2"></i>--}}
                    {{--Отчеты--}}
                {{--</a>--}}
            {{--</li>--}}
        </ul>
    </div>
</div>