<div class="card">
    <div class="card-header bg-transparent header-elements-inline">
        <span class="text-uppercase font-size-sm font-weight-semibold">Остальные расходники</span>
    </div>

    <div class="card-body">
        <ul class="list-group list-group-flush">
            @forelse($other_consumables as $o_consumable)
                <li class="list-group-item">
                    <span class="badge badge-mark mr-1" style="border-color: {{ $o_consumable->getHexColor() }}"></span>
                    <a href="{{ route('inventory.consumables.show', $o_consumable) }}">
                        {{ $o_consumable->getFullName() }}
                    </a>
                    <div class="list-icons ml-auto">
                        <div class="list-icons-item mr-2">
                            <div class="dropup">
                                @if ($o_consumable->stocks->sum('count') != 0)
                                    <a href="#" class="badge badge-flat badge-pill border-primary text-primary-600 dropdown-toggle" data-toggle="dropdown">{{ $o_consumable->stocks->sum('count') }}</a>

                                    <div class="dropdown-menu">
                                        @foreach($o_consumable->stocks as $stock)
                                            <div class="dropdown-item cursor-default">
                                                <span class="mr-3">{{ $stock->object->getFullName() }}</span>
                                                <span class="ml-auto">{{ $stock->count }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="badge badge-flat badge-pill border-dark text-dark-600">0</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <p>Данных нет</p>
            @endforelse
        </ul>
    </div>
</div>