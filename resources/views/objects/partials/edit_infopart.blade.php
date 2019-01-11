<div class="card card-body" style="box-shadow: 0 1px 2px rgba(0,0,0,.2);    border-top: 2px solid #ccc;">
    <div class="form-group">
        {{ Form::hidden('ip_id[]', $infopart->id, []) }}
    </div>
    <div class="form-group">
        {{ Form::text('title[]', $infopart->title, ['class' => 'form-control', 'placeholder' => 'Заголовок блока']) }}
    </div>
    <div class="form-group">
        {!! Form::textarea('content[]', $infopart->body, ['class' => 'summernote', 'placeholder' => 'Контент']) !!}
    </div>
    <div class="form-group">
        <input type="file" name="files[]" multiple="multiple" class="fileuplouder">
    </div>
</div>