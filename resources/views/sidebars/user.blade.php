<!-- Secondary sidebar -->
<div class="sidebar sidebar-light sidebar-secondary sidebar-expand-md">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar search -->
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="search">Поиск</label>
                    <input id="test" type="search" class="form-control" autocomplete="off" placeholder="Имя сотрудника" data-filter-url="{{ route('test') }}">
                </div>

                <div id="search-result-container"></div>
            </div>
        </div>
    </div>
        <!-- /sidebar search -->
</div>
