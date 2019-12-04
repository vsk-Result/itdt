<div class="card">
    <div class="card-header bg-transparent header-elements-inline">
        <span class="card-title font-weight-bold">Ответственные лица</span>
    </div>

    <div class="card-body">
        <ul class="media-list">
            @if($object->persons->count() > 0)
                @each('objects.partials.person', $object->persons, 'person')
            @else
                <li>Данные отсутствуют</li>
            @endif
        </ul>
    </div>
</div>