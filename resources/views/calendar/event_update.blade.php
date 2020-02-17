<div class="modal-header">
    <h4 class="modal-title">
        <a>{{ $event->employee->fullname }}</a>
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
    <button class="btn btn-success" type="submit">Сохранить</button>
</div>

{{Form::close()}}
