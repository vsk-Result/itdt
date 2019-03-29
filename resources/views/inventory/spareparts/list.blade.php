<ul class="list-group list-group-flush">
    @forelse($spareparts as $sparepart)
        <li class="list-group-item">
            <div>
                @if (is_null($sparepart->url))
                    {{ $sparepart->name }}
                @else
                    <a target="_blank" href="{{ $sparepart->url }}">{{ $sparepart->name }}</a>
                @endif
                <p class="text-muted mb-0 font-size-xs">{{ $sparepart->part_number }}</p>
            </div>
            <div class="list-icons ml-auto">
                <div class="list-icons-item dropdown">
                    <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(16px, 16px, 0px);">

                        <a href="javascript:void(0)" class="dropdown-item text-primary edit-sparepart" data-edit-url="{{ route('inventory.spareparts.edit', $sparepart) }}" data-update-url="{{ route('inventory.spareparts.update', $sparepart) }}"><i class="icon-pencil7"></i> Изменить</a>

                        <div class="dropdown-divider"></div>

                        <form id="destroy-sparepart-form-{{ $sparepart->id }}" method="POST" action="{{ route('inventory.spareparts.destroy', $sparepart) }}" class="mr-1">
                            @csrf
                            @method('DELETE')
                            <a href="javascript:void(0)" class="dropdown-item text-danger-800 destroy-sparepart" data-id="{{ $sparepart->id }}"><i class="icon-cross2"></i> Удалить</a>
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