<div class="modal-header">
  <h4 class="modal-title">
    <a href="#">{{ $event->employee->fullname }}</a>
  </h4>
</div>

{{Form::open(['url' => route('event_update'), 'method' => 'GET'])}}
<input type="hidden" name="id" value="{{$event->id}}">
<div class="modal-body">
    <p>
      <b>Заголовок*</b>
    </p>
    <div class="form-group">
      <div class="fg-line">
        <input type="text" required name="title" class="form-control new-event-title" placeholder="Он будет отображаться в календаре буквально 2 - 3 слова.." value="{{$event->title}}">
      </div>
    </div>

    <p>
      <b>Дата начала и окончания события*</b>
    </p>
    <div class="row">
      <div class="form-group col-md-6">
        <p>
          <b>Дата начала встречи*</b>
        </p>
        <div class="fg-line">
          <input required type="date" name="start_date" class="form-control new-event-start-date" value="{{Carbon\Carbon::parse($event->start_date)->format('Y-m-d')}}">
        </div>
      </div>

      <div class="form-group col-md-6">
        <p>
          <b>Время начала встречи*</b>
        </p>
        <div class="fg-line">
          <input required type="time" name="start_time" class="form-control" value="{{Carbon\Carbon::parse($event->start_date)->format('H:i')}}">
        </div>
      </div>

      <div class="form-group col-md-6">
        <p>
          <b>Дата окончания встречи*</b>
        </p>
        <div class="fg-line">
          <input required type="date" name="end_date" class="form-control new-event-end-date" value="{{Carbon\Carbon::parse($event->end_date)->format('Y-m-d')}}">
        </div>
      </div>

      <div class="form-group col-md-6">
        <p>
          <b>Время окончания встречи*</b>
        </p>
        <div class="fg-line">
          <input required type="time" name="end_time" class="form-control" value="{{Carbon\Carbon::parse($event->end_date)->format('H:i')}}">
        </div>
      </div>
    </div>

    <p>
      Дополнительная информация
    </p>
    <div class="form-group">
      <div class="fg-line">
        <textarea class="form-control new-event-description auto-size" name="description" rows="4" placeholder="Описание события, приветствие и вся необходимая информация..">{{$event->description}}</textarea>
      </div>
    </div>
</div>

<div class="modal-footer">
     <button class="btn btn-primary" type="submit">Сохранить</button>
</div>
<div class="modal-footer">
  @if ($event->confirmed !== 1)
    <button class="btn btn-primary event-confirm" data-id="{{$event->id}}" data-dismiss="modal">
      <span class="hidden-xs hidden-sm">Подтвердить</span>
      <i class="zmdi zmdi-check hidden-md hidden-bg hidden-lg"></i>
    </button>
  @endif

  @if ($event->confirmed !== 0)
    <button class="btn btn-primary event-define" data-id="{{$event->id}}" data-dismiss="modal">
      <span class="hidden-xs hidden-sm">Отклонить</span>
      <i class="zmdi zmdi-close hidden-md hidden-bg hidden-lg"></i>
    </button>
  @endif
</div>
{{Form::close()}}
