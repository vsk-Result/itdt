<div class="sidebar sidebar-light sidebar-right sidebar-expand-lg search-sidebar">
    <div class="sidebar-content">
        <div class="card">
            <div class="card-header bg-transparent header-elements-inline">
                <span class="text-uppercase font-size-sm font-weight-semibold">Поиск сотрудников</span>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="sidebar-right-toggle list-icons-item cursor-pointer"><i class="icon icon-cross2"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input id="userFilter"
                           type="search"
                           class="form-control"
                           placeholder="Петрович Любомир"
                           data-filter-url="{{ route('users.filter') }}"
                           data-online-url="{{ route('users.online') }}">
                </div>
                <div id="search-result-container"></div>
            </div>
        </div>
    </div>
</div>
