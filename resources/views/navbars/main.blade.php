<div class="navbar navbar-expand-md navbar-dark">
    {{--<div class="navbar-brand">--}}
        {{--<a href="#" class="d-inline-block">--}}
            {{--<img src="{{ asset('images/dtsti_logo.png') }}" alt="">--}}
        {{--</a>--}}
    {{--</div>--}}

    <div class="d-md-none p-2">
        @if (Auth::user()->hasPermission('objects'))
            <a href="{{ route('objects.index') }}" class="navbar-toggler"><i class="icon-city mr-2"></i></a>
        @endif
        @if (Auth::user()->hasPermission('task_manager'))
            <a href="{{ route('tasks.index') }}" class="navbar-toggler"><i class="icon-task mr-2"></i></a>
        @endif
        @if (Auth::user()->hasPermission('consumables'))
            <a href="{{ route('inventory.index') }}" class="navbar-toggler"><i class="icon-printer mr-2"></i></a>
        @endif
        @if (Auth::user()->hasPermission('knowledge'))
            <a href="{{ route('knowledge.index') }}" class="navbar-toggler"><i class="icon-brain mr-2"></i></a>
        @endif
        @if (Auth::user()->hasPermission('keys'))
            <a href="{{ route('keys.index') }}" class="navbar-toggler"><i class="icon-key mr-2"></i></a>
        @endif
        <a href="#" class="navbar-toggler" data-toggle="modal" data-target="#createSign"><i class="icon-quill4 mr-2"></i></a>
        @if (Auth::user()->hasPermission('users'))
            <a href="{{ route('users.index') }}" class="navbar-toggler"><i class="icon-users mr-2"></i></a>
        @endif
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile" style="margin-left: -2.3rem;">
        <ul class="navbar-nav">
                <li class="navbar-nav" id="toster">
                    <a href="#" class="navbar-nav-link sidebar-control sidebar-secondary-toggle d-none d-md-block">
                        <i class="icon-people"></i></a>
                </li>
            @if (Auth::user()->hasPermission('objects'))
                <li class="nav-item">
                    <a href="{{ route('objects.index') }}" class="navbar-nav-link"><i class="icon-city mr-2"></i><span>Объекты</span></a>
                </li>
            @endif
            @if (Auth::user()->hasPermission('task_manager'))
                <li class="nav-item">
                    <a href="{{ route('tasks.index') }}" class="navbar-nav-link"><i class="icon-task mr-2"></i><span>Менеджер задач</span></a>
                </li>
            @endif
            @if (Auth::user()->hasPermission('consumables'))
                <li class="nav-item">
                    <a href="{{ route('inventory.index') }}" class="navbar-nav-link"><i class="icon-printer mr-2"></i><span>Расходные материалы</span></a>
                </li>
            @endif
            @if (Auth::user()->hasPermission('knowledge'))
                <li class="nav-item">
                    <a href="{{ route('knowledge.index') }}" class="navbar-nav-link"><i class="icon-brain mr-2"></i><span>База знаний</span></a>
                </li>
            @endif
            @if (Auth::user()->hasPermission('keys'))
                <li class="nav-item">
                    <a href="{{ route('keys.index') }}" class="navbar-nav-link"><i class="icon-key mr-2"></i><span>Лицензии</span></a>
                </li>
            @endif
            <li class="nav-item">
                <a href="#" class="navbar-nav-link" data-toggle="modal" data-target="#createSign"><i class="icon-quill4 mr-2"></i><span>Подписи</span></a>
            </li>
            @if (Auth::user()->hasPermission('users'))
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="navbar-nav-link"><i class="icon-users mr-2"></i><span>Пользователи</span></a>
                </li>
            @endif
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown dropdown-user">
                <a href="#" class="navbar-nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset('images/placeholder.jpg') }}" width="38" height="38" class="rounded-circle" alt="">
                    <span class="ml-2">{{ Auth::user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">

                    {{--<a href="{{ route('cabinet.profile.home') }}" class="dropdown-item"><i class="icon-profile"></i> Личный кабинет</a>--}}

                    {{--<div class="dropdown-divider"></div>--}}

                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-switch2"></i> Выйти</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                </div>
            </li>
        </ul>
    </div>
</div>
