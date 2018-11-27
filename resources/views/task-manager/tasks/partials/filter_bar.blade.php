<div id="filter-bar" class="navbar navbar-expand-lg navbar-light navbar-component rounded">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-filter">
            <i class="icon-unfold mr-2"></i>
            Фильтры
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-filter">
        <span class="navbar-text font-weight-semibold mr-3">
            Фильтр:
        </span>

        <ul class="navbar-nav flex-wrap">
            <li class="nav-item dropdown">
                <a href="javascript:void(0)" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-sort-time-asc mr-2"></i>
                    По типу
                </a>

                <div class="dropdown-menu">
                    <a href="javascript:void(0)" data-type-id="all" class="type-list-item filter-list-item dropdown-item active">Показать все</a>
                    <div class="dropdown-divider"></div>
                    @foreach($types as $type)
                        <a href="javascript:void(0)" data-type-id="{{ $type->id }}" class="type-list-item filter-list-item dropdown-item">{{ $type->name }}</a>
                    @endforeach
                </div>
            </li>

            <li class="nav-item dropdown">
                <a href="javascript:void(0)" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-sort-amount-desc mr-2"></i>
                    По статусу
                </a>

                <div class="dropdown-menu">
                    <a href="javascript:void(0)" data-status-id="all" class="status-list-item filter-list-item dropdown-item active">Показать все</a>
                    <div class="dropdown-divider"></div>
                    @foreach($statuses as $status)
                        <a href="javascript:void(0)" data-status-id="{{ $status->id }}" class="status-list-item filter-list-item dropdown-item">{{ $status->name }}</a>
                    @endforeach
                </div>
            </li>

            <li class="nav-item dropdown">
                <a href="javascript:void(0)" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-sort-numeric-asc mr-2"></i>
                    По приоритету
                </a>

                <div class="dropdown-menu">
                    <a href="javascript:void(0)" data-priority-id="all" class="priority-list-item filter-list-item dropdown-item active">Показать все</a>
                    <div class="dropdown-divider"></div>
                    @foreach($priorities as $priority)
                        <a href="javascript:void(0)" data-priority-id="{{ $priority->id }}" class="priority-list-item filter-list-item dropdown-item">{{ $priority->name }}</a>
                    @endforeach
                </div>
            </li>
        </ul>

        <span class="navbar-text font-weight-semibold mr-3 ml-md-auto">
            <a href="javascript:void(0)" id="filter-reset">Сбросить</a>
        </span>
    </div>
</div>