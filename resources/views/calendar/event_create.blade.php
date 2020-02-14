<div class="modal-header">
    <h4 class="modal-title">Новая встреча в зале совещаний</h4>
</div>

{{Form::open(['url' => route('event_create'), 'method' => 'GET'])}}
<div class="modal-body">
    <p>
        <b>Заголовок*</b>
    </p>
    <div class="form-group">
        <div class="fg-line">
            <input type="text" required name="title" class="form-control new-event-title" placeholder="Он будет отображаться в календаре буквально 2 - 3 слова..">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <p>
                <b>Дата начала встречи*</b>
            </p>
            <div class="fg-line">
                <input required type="date" name="start_date" class="form-control new-event-start-date" placeholder="">
            </div>
        </div>

        <div class="form-group col-md-6">
            <p>
                <b>Время начала встречи*</b>
            </p>
            <div class="fg-line">
                <input required type="time" name="start_time" class="form-control" placeholder="" value="12:00">
            </div>
        </div>

        <div class="form-group col-md-6">
            <p>
                <b>Дата окончания встречи*</b>
            </p>
            <div class="fg-line">
                <input required type="date" name="end_date"  class="form-control new-event-end-date" placeholder="">
            </div>
        </div>

        <div class="form-group col-md-6">
            <p>
                <b>Время окончания встречи*</b>
            </p>
            <div class="fg-line">
                <input required type="time" name="end_time" min="" class="form-control" placeholder="" value="13:00">
            </div>
        </div>
    </div>

    <p>
        Дополнительная информация
    </p>
    <div class="form-group">
        <div class="fg-line">
            <textarea class="form-control new-event-description auto-size" name="description" placeholder="Описание события, приветствие и вся необходимая информация.."></textarea>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button class="btn btn-primary" type="submit">Создать</button>
    <button class="btn btn-primary" data-dismiss="modal">Закрыть</button>
</div>
{{Form::close()}}
