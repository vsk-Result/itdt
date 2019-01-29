<div class="col-md-3">
    <div class="card">
        <div class="card-img-actions">
            <a href="{{ route('objects.show', [$object->id]) }}">
                <img class="card-img-top img-fluid" src="{{ $object->getImageUrl() }}" alt="">
            </a>
        </div>

        <div class="card-body">
            <h5 class="card-title"><a href="{{ route('objects.show', [$object->id]) }}">{{ $object->getFullName() }}</a></h5>
            <p class="card-text">{{ $object->address }}</p>
        </div>

        <div class="card-footer" style="min-height: 50px;">
            <div>
                @if ($object->tasks()->active()->count() > 0)
                    <div class="progress rounded-round" style="width: 80%; float: left;">
                        <div class="progress-bar bg-primary-400" style="width: {{ $object->getTasksPercentage() }}%">
                            <span>{{ $object->getTasksPercentage() }}%</span>
                        </div>

                        <div class="progress-bar bg-warning" style="width: {{ $object->getPurchasesPercentage() }}%">
                            <span>{{ $object->getPurchasesPercentage() }}%</span>
                        </div>

                        <div class="progress-bar bg-success" style="width: {{ $object->getEvolutionsPercentage() }}%">
                            <span>{{ $object->getEvolutionsPercentage() }}%</span>
                        </div>
                    </div>
                @endif
                @if ($object->getSolvedTasksCount() > 0)
                    <span class="badge badge-flat badge-pill border-danger text-danger-600 ml-2" style="padding: calc(.2625rem - 1px) calc(.475rem - 1px);">{{ $object->getSolvedTasksCount() }}</span>
                @endif
            </div>
        </div>
    </div>
</div>