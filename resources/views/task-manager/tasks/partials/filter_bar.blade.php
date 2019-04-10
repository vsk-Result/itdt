<div id="filter-bar" class="navbar navbar-expand-lg navbar-light navbar-component rounded">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-filter">
            <i class="icon-unfold mr-2"></i>
            Фильтры
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-filter">
        <div>
            <div class="form-check form-check-switchery form-check-switchery-double form-check-switchery mb-3 mb-lg-0">
                <label class="form-check-label">
                    Мои
                    <input id="tasks-my-other" type="checkbox" class="form-check-filter-input-switchery" checked data-fouc>
                    Все
                </label>
            </div>
            <br>
            <div class="form-check form-check-switchery form-check-switchery-double form-check-switchery mb-3 mb-lg-0">
                <label class="form-check-label">
                    Активные
                    <input id="tasks-active" type="checkbox" class="form-check-filter-input-switchery" data-fouc>
                    Все
                </label>
            </div>
        </div>


        <ul class="navbar-nav flex-wrap ml-2">
            <li class="nav-item dropdown">
                <a href="javascript:void(0)" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-sort-alpha-asc mr-2"></i>
                    По типу
                    <span class="filter-subtitle">(Все)</span>
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
                    <i class="icon-sort-time-asc mr-2"></i>
                    По статусу
                    <span class="filter-subtitle">(Все)</span>
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
                    <span class="filter-subtitle">(Все)</span>
                </a>

                <div class="dropdown-menu">
                    <a href="javascript:void(0)" data-priority-id="all" class="priority-list-item filter-list-item dropdown-item active">Показать все</a>
                    <div class="dropdown-divider"></div>
                    @foreach($priorities as $priority)
                        <a href="javascript:void(0)" data-priority-id="{{ $priority->id }}" class="priority-list-item filter-list-item dropdown-item">{{ $priority->name }}</a>
                    @endforeach
                </div>
            </li>

            <li class="nav-item dropdown">
                <a href="javascript:void(0)" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-sort-alpha-asc mr-2"></i>
                    По автору
                    <span class="filter-subtitle">(Все)</span>
                </a>

                <div class="dropdown-menu">
                    <a href="javascript:void(0)" data-author-id="all" class="author-list-item filter-list-item dropdown-item active">Показать все</a>
                    <div class="dropdown-divider"></div>
                    @foreach($authors as $author)
                        <a href="javascript:void(0)" data-author-id="{{ $author->id }}" class="author-list-item filter-list-item dropdown-item">{{ $author->name }}</a>
                    @endforeach
                </div>
            </li>

            <li class="nav-item dropdown">
                <a href="javascript:void(0)" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-sort-numeric-asc mr-2"></i>
                    По объекту
                    <span class="filter-subtitle">(Все)</span>
                </a>

                <div class="dropdown-menu">
                    <a href="javascript:void(0)" data-object-id="all" class="object-list-item filter-list-item dropdown-item active">Показать все</a>
                    <div class="dropdown-divider"></div>
                    @foreach($objects as $object)
                        <a href="javascript:void(0)" data-object-id="{{ $object->id }}" class="object-list-item filter-list-item dropdown-item">{{ $object->getFullName() }}</a>
                    @endforeach
                </div>
            </li>

            <li class="nav-item dropdown">
                <a href="javascript:void(0)" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-sort mr-2"></i>
                    Сортировка
                    <span class="filter-subtitle"></span>
                </a>

                <div class="dropdown-menu">
                    <a href="javascript:void(0)" data-sort-id="all" class="sort-list-item filter-list-item dropdown-item active">Стандартная</a>
                    <div class="dropdown-divider"></div>
                    @foreach($sorts as $key => $value)
                        <a href="javascript:void(0)" data-sort-id="{{ $key }}" data-sort-dir="asc" class="sort-list-item filter-list-item dropdown-item">
                            {{ $value }}
                            <span class="sort-dir"></span>
                        </a>
                    @endforeach
                </div>
            </li>
        </ul>

        <span class="navbar-text font-weight-semibold mr-3 ml-md-auto">
            <a href="javascript:void(0)" id="filter-reset">Сбросить</a>
        </span>

        <div class="navbar-collapse collapse" id="navbar-form-icons">
            <div class="my-3 my-xl-0">
                <div class="form-group-feedback form-group-feedback-left mb-3 mb-xl-0">
                    <input id="filter-search-input" type="text" class="form-control" style="width: 165px;" placeholder="Поиск...">
                    <div class="form-control-feedback">
                        <i class="icon-search4 text-muted font-size-base"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>