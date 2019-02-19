<div class="card">
    <div class="card-header bg-transparent header-elements-inline">
        <span class="text-uppercase font-size-sm font-weight-semibold">Наличие на объектах</span>
    </div>

    <table class="table table-borderless table-xs my-2">
        <tbody>
            @foreach($consumable->stocks as $stock)
                <tr>
                    <td>{{ $stock->object->getFullname() }}</td>
                    <td class="text-right">{{ $stock->count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>