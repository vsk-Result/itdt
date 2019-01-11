<div class="card gallery">
    <div class="card-header bg-transparent header-elements-inline">
        <span class="card-title font-weight-bold">Галлерея</span>
    </div>

    <div class="card-body">
        <div class="row">
            @forelse($object->images as $image)
                <div class="col-md-6">
                    <div class="mb-2">
                        <div class="card-img-actions">
                            <a href="{{ $image->getUrl() }}">
                                <img class="card-img img-fluid" src="{{ $image->getUrl() }}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                Данные отсутствуют
            @endforelse
        </div>
    </div>
</div>