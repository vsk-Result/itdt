<div class="modal-header">
  <h4 class="modal-title">
    <a href="#">{{$event->employee->fullname}}</a>
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
<button class="btn btn-primary event-destroy" data-id="{{$event->id}}">
    <span class="hidden-xs hidden-sm">Удалить</span>
</button>
  <button data-event-id="{{$event->id}}" id ="vlad" class="btn btn-primary">Редактировать</button>
  <button class="btn btn-primary" data-dismiss="modal">Закрыть</button>
</div>
