<div class="modal-header">
    <h4 class="modal-title">
        <a>{{$event->employee->fullname}}</a>
    </h4>
</div>

<div class="modal-body">
    <div class="">
        <b>Заголовок</b>
        <p>
            {{$event->title}}
        </p>
    </div>

    <p>
        <b>Дата начала и окончания события</b>
    </p>

    <div class="row">
        <div class="col-md-6">
            Начало:
            <p>
                <b>{{Carbon\Carbon::parse($event->start_date)->format('d.m.Y')}} {{Carbon\Carbon::parse($event->start_date)->format('H:i')}}</b>
            </p>
        </div>

        <div class="col-md-6">
            Окончание:
            <p>
                <b>{{Carbon\Carbon::parse($event->end_date)->format('d.m.Y')}} {{Carbon\Carbon::parse($event->end_date)->format('H:i')}}</b>
            </p>
        </div>
        @if ($event->description)
            <div class="col-md-12" style="word-wrap: break-word;">
                <b>Описание</b>
                <p>{{$event->description}}</p>
            </div>
        @endif
    </div>
</div>
<div class="modal-footer">

    @if (Auth::user()->hasPermission('calendar') || Auth::id() == $event->employee_id)
        @if ($event->confirmed !== 1)
            <button class="btn btn-success event-confirm" data-id="{{$event->id}}" data-dismiss="modal">
                <span class="hidden-xs hidden-sm">Подтвердить</span>
                <i class="zmdi zmdi-check hidden-md hidden-bg hidden-lg"></i>
            </button>
        @endif

        @if ($event->confirmed !== 0)
            <button class="btn btn-warning event-define" data-id="{{$event->id}}" data-dismiss="modal">
                <span class="hidden-xs hidden-sm">Отклонить</span>
                <i class="zmdi zmdi-close hidden-md hidden-bg hidden-lg"></i>
            </button>
        @endif
        <button data-event-id="{{$event->id}}" id="vlad" class="btn btn-success">Редактировать</button>
        <button class="btn btn-danger event-destroy" data-id="{{$event->id}}">
            <span class="hidden-xs hidden-sm">Удалить</span>
        </button>
    @endif
</div>
