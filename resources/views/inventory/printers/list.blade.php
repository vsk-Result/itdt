<ul class="list-group list-group-flush">
        @forelse($printers as $printer)
                <li class="list-group-item">
                        <div>
                            {{ $printer->getFullName() }}
                            <p class="text-muted mb-0 font-size-xs">{{ $printer->object->getFullName() }}</p>
                        </div>
                        <div class="list-icons ml-auto">
                                <div class="list-icons-item dropdown">
                                        <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown" aria-expanded="false"><i class="icon-menu7"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(16px, 16px, 0px);">

                                                <a href="javascript:void(0)" class="dropdown-item text-primary edit-printer" data-edit-url="{{ route('inventory.printers.edit', $printer) }}" data-update-url="{{ route('inventory.printers.update', $printer) }}"><i class="icon-pencil7"></i> Изменить</a>

                                                <div class="dropdown-divider"></div>

                                                <form id="destroy-printer-form-{{ $printer->id }}" method="POST" action="{{ route('inventory.printers.destroy', $printer) }}" class="mr-1">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="javascript:void(0)" class="dropdown-item text-danger-800 destroy-printer" data-id="{{ $printer->id }}"><i class="icon-cross2"></i> Удалить</a>
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