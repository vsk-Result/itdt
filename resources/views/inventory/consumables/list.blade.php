<ul class="list-group list-group-flush">
    @forelse($consumables as $consumable)
        <li class="list-group-item">
            <span class="badge badge-mark mr-1" style="border-color: {{ $consumable->getHexColor() }}"></span>
            <a href="{{ route('inventory.consumables.show', $consumable) }}">
                {{ $consumable->getFullName() }}
            </a>
            <div class="list-icons ml-auto">
                <div class="list-icons-item mr-2">
                    <div class="dropup">
                        @if ($consumable->stocks->sum('count') != 0)
                            <a href="#" class="badge badge-flat badge-pill border-primary text-primary-600 dropdown-toggle" data-toggle="dropdown">{{ $consumable->stocks->sum('count') }}</a>

                            <div class="dropdown-menu">
                                @foreach($consumable->stocks as $stock)
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
                <div class="list-icons-item dropdown">
                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(16px, 16px, 0px);">

                        <a href="javascript:void(0)" class="dropdown-item text-primary edit-consumable" data-edit-url="{{ route('inventory.consumables.edit', $consumable) }}" data-update-url="{{ route('inventory.consumables.update', $consumable) }}"><i class="icon-pencil7"></i> Изменить</a>

                        <div class="dropdown-divider"></div>

                        <form id="destroy-consumable-form-{{ $consumable->id }}" method="POST" action="{{ route('inventory.consumables.destroy', $consumable) }}" class="mr-1">
                            @csrf
                            @method('DELETE')
                            <a href="javascript:void(0)" class="dropdown-item text-danger-800 destroy-consumable" data-id="{{ $consumable->id }}"><i class="icon-cross2"></i> Удалить</a>
                        </form>
                    </div>
                </div>
            </div>
        </li>
    @empty
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                Данных нет
            </li>
        </ul>
    @endforelse
</ul>