<div class="col-md-3">
    <div class="card">
        <div class="card-img-actions">
            <a href="{{ route('objects.show', [$object->id]) }}">
                <img class="card-img-top img-fluid" src="{{ $object->getThumbUrl() }}" alt="">
            </a>
        </div>

        <div class="card-body">
            <h5 class="card-title" style="z-index: 1;"><a href="{{ route('objects.show', [$object->id]) }}">{{ $object->getFullName() }}</a></h5>
            <p class="card-text">{{ $object->address }}</p>
        </div>

        @if (!$object->isActive())
            <div class="blockUI blockOverlay"></div>
        @endif

        <div class="card-footer" style="min-height: 50px;">
            <div>
                @if ($object->tasks()->active()->count() > 0)
                    <div style="background: #fff;padding: 1px 25px 1px 1px;border: 1px solid #bebfbf;border-radius: 45px;position: relative;">
                        <div class="progress rounded-round">
                            <div class="progress-bar bg-primary-400" style="width: {{ $object->getTasksPercentage() }}%">
                                <span title="Задачи">{{ $object->getTasksPercentage() }}%</span>
                            </div>

                            <div class="progress-bar bg-warning" style="width: {{ $object->getPurchasesPercentage() }}%">
                                <span title="Закупка">{{ $object->getPurchasesPercentage() }}%</span>
                            </div>

                            <div class="progress-bar bg-success" style="width: {{ $object->getEvolutionsPercentage() }}%">
                                <span title="Развитие">{{ $object->getEvolutionsPercentage() }}%</span>
                            </div>
                        </div>
                        <div title="Завершенные" style="position: absolute; top: 2px; right: 8px; font-size: .7rem;">{{ $object->getSolvedTasksCount() }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>