<div class="card">
    <div class="card-header bg-transparent header-elements-inline">
        <span class="text-uppercase font-size-sm font-weight-semibold">Основная информация</span>
    </div>

    <table class="table table-borderless table-xs my-2">
        <tbody>
        <tr>
            <td><i class="icon-briefcase mr-2"></i> Модель:</td>
            <td class="text-right">{{ $consumable->name }}</td>
        </tr>
        <tr>
            <td><i class="icon-history mr-2"></i> Цвет:</td>
            <td class="text-right"><span class="badge badge-mark mr-1" style="border-color: {{ $consumable->getHexColor() }}"></span>{{ $consumable->getColorName() }}</td>
        </tr>
        <tr>
            <td><i class="icon-file-check mr-2"></i> Фото:</td>
            <td class="text-right"></td>
        </tr>
        <tr>
            <td><i class="icon-file-check mr-2"></i> Кол-во замен:</td>
            <td class="text-right">{{ $consumable->replacements->count() }}</td>
        </tr>
        </tbody>
    </table>
</div>