<div class="col-md-3">
    <div class="card">
        <div class="card-img-actions">
            <img class="card-img-top img-fluid" src="{{ $object->getImageUrl() }}" alt="">
        </div>

        <div class="card-body">
            <h5 class="card-title"><a href="{{ route('objects.show', [$object->id]) }}">{{ $object->getFullName() }}</a></h5>
            <p class="card-text">{{ $object->address }}</p>
        </div>

        <div class="card-footer d-flex justify-content-between">

        </div>
    </div>
</div>