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
            <span class="text-muted">Last updated 3 mins ago</span>
            <span>
                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                <i class="icon-star-full2 font-size-base text-warning-300"></i>
                <i class="icon-star-half font-size-base text-warning-300"></i>
                <span class="text-muted ml-2">(12)</span>
            </span>
        </div>
    </div>
</div>