<div class="col-md-3">
    <div class="card">
        <div class="card-img-actions">
            <a href="{{ route('objects.show', [$object->id]) }}">
                <img class="card-img-top img-fluid" src="{{ $object->getImageUrl() }}" alt="">
            </a>
        </div>

        <div class="card-body pb-2">
            <h5 class="card-title"><a href="{{ route('objects.show', [$object->id]) }}">{{ $object->getFullName() }}</a></h5>
            <p class="card-text">{{ $object->address }}</p>
            <ul class="list-inline list-inline-condensed mb-0">
                <li class="list-inline-item">
                    <span class="badge badge-flat badge-pill border-success text-success-600">{{ $object->getOpenedTasksCount() }}</span>
                </li>
                <li class="list-inline-item">
                    <span class="badge badge-flat badge-pill border-primary text-primary-600">{{ $object->getDelayedTasksCount() }}</span>
                </li>
                <li class="list-inline-item">
                    <span class="badge badge-flat badge-pill border-danger text-danger-600">{{ $object->getSolvedTasksCount() }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>