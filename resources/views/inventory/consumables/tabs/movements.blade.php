<table class="table movements-list table-lg table-hover">
    <thead>
        <tr>
            <th>Автор</th>
            <th>Маршрут</th>
            <th>Кол-во</th>
            <th>Статус</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($consumable->getMovements() as $movement)
            <tr>
                <td>
                    {{ $movement->user->name }} <br>
                    <p class="text-muted mb-0 font-size-xs">{{ $movement->created_at->format('d.m.Y H:i') }}</p>
                </td>
                <td>
                    {{ $movement->isArrival() ? 'Приход материала' : $movement->sender->getFullName() }}
                    ->
                    {{ $movement->recipient->getFullName() }}
                    @if ($movement->isWriteOff())
                        <p class="mb-0 font-size-xs text-danger-800">Списание без подтверждения замены</p>
                    @endif
                    <p class="text-muted mb-0 font-size-xs">{{ $movement->comment }}</p>
                </td>
                <td>{{ $movement->count }}</td>
                <td>
                    @if($movement->isConfirmed())
                        <a class="popover-info" href="javascript:void(0);" data-popup="tooltip" data-html="true" data-content="<ul class='font-size-sm text-muted pl-0 mb-0'><li class='list-inline-item'>Автор: {{ $movement->confirmUser->name }}</li><li class='list-inline-item'>Подтверждено: {{ $movement->confirmed_at->format('d.m.Y H:i') }}</li>">{{ $movement->getStatus() }}</a>
                    @else
                        {{ $movement->getStatus() }}
                    @endif
                </td>
                <td>
                    <div class="list-icons">
                        <div class="list-icons-item dropdown">
                            <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(16px, 16px, 0px);">

                                @if($movement->isPending())
                                    <form id="confirm-form-{{ $movement->id }}" method="POST" action="{{ route('inventory.consumables.movements.confirm', [$consumable, $movement]) }}" class="mr-1">
                                        @csrf
                                        <a href="javascript:void(0)" onclick="document.getElementById('confirm-form-{{ $movement->id }}').submit();" class="dropdown-item text-success"><i class="icon-checkmark2"></i> Подтвердить</a>
                                    </form>
                                @endif

                                @if($movement->isConfirmed())
                                        <form id="pending-form-{{ $movement->id }}" method="POST" action="{{ route('inventory.consumables.movements.pending', [$consumable, $movement]) }}" class="mr-1">
                                            @csrf
                                            <a href="javascript:void(0)" onclick="document.getElementById('pending-form-{{ $movement->id }}').submit();" class="dropdown-item text-warning"><i class="icon-reset"></i> Откатить</a>
                                        </form>
                                @endif

                                <a href="javascript:void(0)" class="dropdown-item text-primary edit-movement" data-edit-url="{{ route('inventory.consumables.movements.edit', [$consumable, $movement]) }}" data-update-url="{{ route('inventory.consumables.movements.update', [$consumable, $movement]) }}"><i class="icon-pencil7"></i> Изменить</a>

                                <div class="dropdown-divider"></div>

                                <form id="destroy-form-{{ $movement->id }}" method="POST" action="{{ route('inventory.consumables.movements.destroy', [$consumable, $movement]) }}" class="mr-1">
                                    @csrf
                                    @method('DELETE')
                                    <a href="javascript:void(0)" class="dropdown-item text-danger-800 destroy-movement" data-id="{{ $movement->id }}"><i class="icon-cross2"></i> Удалить</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>