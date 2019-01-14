<div class="card gallery">
    <div class="card-header bg-transparent header-elements-inline">
        <span class="card-title font-weight-bold">Галлерея</span>
    </div>

    <div class="card-body">
        @foreach($object->images as $image)
            <div id="caption{{ $image->id }}" style="display:none">
                <p>{{ $image->description }}</p>
            </div>
        @endforeach
        <div class="row lightgallery">
            @forelse($object->images as $image)
                <div class="col-md-6">
                    <div class="mb-2">
                        <div class="card-img-actions">
                            <a data-src="{{ $image->getUrl() }}" class="light-item cursor-pointer" data-sub-html="#caption{{ $image->id }}">
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