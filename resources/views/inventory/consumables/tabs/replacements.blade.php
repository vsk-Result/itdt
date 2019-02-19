<table class="table replacements-list table-lg table-hover">
    <thead>
        <tr>
            <th>Автор</th>
            <th>Принтер</th>
            <th>Дата замены</th>
            <th>Комментарий</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach($consumable->getReplacements() as $replacement)
        <tr>
            <td>
                {{ $replacement->user->name }} <br>
                <p class="text-muted mb-0 font-size-xs">{{ $replacement->created_at->format('d.m.Y H:i') }}</p>
            </td>
            <td>{{ $replacement->printer->name }}</td>
            <td>{{ $replacement->replaced_at->format('d.m.Y') }}</td>
            <td>{{ $replacement->comment }}</td>
            <td>
                <div class="list-icons">
                    <div class="list-icons-item dropdown">
                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(16px, 16px, 0px);">

                            <a href="javascript:void(0)" class="dropdown-item text-primary edit-replacement" data-edit-url="{{ route('inventory.consumables.replacements.edit', [$consumable, $replacement]) }}" data-update-url="{{ route('inventory.consumables.replacements.update', [$consumable, $replacement]) }}"><i class="icon-pencil7"></i> Изменить</a>

                            <div class="dropdown-divider"></div>

                            <form id="destroy-replacement-form-{{ $replacement->id }}" method="POST" action="{{ route('inventory.consumables.replacements.destroy', [$consumable, $replacement]) }}" class="mr-1">
                                @csrf
                                @method('DELETE')
                                <a href="javascript:void(0)" class="dropdown-item text-danger-800 destroy-replacement" data-id="{{ $replacement->id }}"><i class="icon-cross2"></i> Удалить</a>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>