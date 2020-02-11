<div class="sidebar sidebar-light sidebar-right sidebar-expand-lg">
    <div class="sidebar-content">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <input id="userFilter"
                           type="search"
                           class="form-control"
                           placeholder="Поиск сотрудников"
                           data-filter-url="{{ route('users.filter') }}"
                           data-online-url="{{ route('users.online') }}">
                </div>
                <div id="search-result-container"></div>
            </div>
        </div>
    </div>
</div>
