<div class="card">
    <div class="card-header bg-transparent header-elements-inline">
        <span class="text-uppercase font-size-sm font-weight-semibold">Совместимость</span>
    </div>

    <div class="card-body">
        <ul class="list list-unstyled mb-0">
            @foreach($consumable->printers as $printer)
                <li>
                    {{ $printer->name }}
                </li>
            @endforeach
        </ul>
    </div>
</div>