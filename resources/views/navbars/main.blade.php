<div class="navbar navbar-expand-md navbar-dark">
    {{--<div class="navbar-brand">--}}
        {{--<a href="#" class="d-inline-block">--}}
            {{--<img src="{{ asset('images/dtsti_logo.png') }}" alt="">--}}
        {{--</a>--}}
    {{--</div>--}}

    <div class="d-md-none p-2">
        <a href="{{ route('home') }}" class="navbar-toggler"><i class="icon-city mr-2"></i></a>
        <a href="{{ route('tasks.index') }}" class="navbar-toggler"><i class="icon-task mr-2"></i></a>
        <a href="{{ route('inventory.index') }}" class="navbar-toggler"><i class="icon-printer mr-2"></i></a>
        <a href="{{ route('knowledge.index') }}" class="navbar-toggler"><i class="icon-brain mr-2"></i></a>
        <a href="{{ route('keys.index') }}" class="navbar-toggler"><i class="icon-key mr-2"></i></a>
    </div>

    <div class="collapse navbar-collapse" id="navbar-mobile" style="margin-left: -2.3rem;">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="navbar-nav-link"><i class="icon-city mr-2"></i><span>Объекты</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('tasks.index') }}" class="navbar-nav-link"><i class="icon-task mr-2"></i><span>Менеджер задач</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('inventory.index') }}" class="navbar-nav-link"><i class="icon-printer mr-2"></i><span>Расходные материалы</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('knowledge.index') }}" class="navbar-nav-link"><i class="icon-brain mr-2"></i><span>База знаний</span></a>
            </li>
            <li class="nav-item">
                <a href="{{ route('keys.index') }}" class="navbar-nav-link"><i class="icon-key mr-2"></i><span>Лицензии</span></a>
            </li>
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