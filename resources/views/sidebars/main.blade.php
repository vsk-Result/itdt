<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Навигация
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <!-- Main -->
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link"><i class="icon-city"></i><span>Главная</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tasks.index') }}" class="nav-link"><i class="icon-task"></i><span>Менеджер задач</span></a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('inventory.index') }}" class="nav-link"><i class="icon-printer"></i><span>Расходные материалы</span></a>
                </li>
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->