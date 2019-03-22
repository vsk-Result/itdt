<div class="col-md-6 fileuploader-item file-has-popup">
    <div class="row py-0">
        <div class="col-md-6" style="min-height: 120px">
            <div class="fileuploader-item-inner light-item" data-src="{{ $image->getUrl() }}" data-sub-html="#caption{{ $image->id }}">
                <div class="thumbnail-holder">
                    <div class="fileuploader-item-image">
                        <img src="{{ $image->getUrl() }}">
                    </div>
                    <span class="fileuploader-action-popup"></span>

                    <div class="content-holder">
                        <h5></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-1">
                {{ Form::hidden('image_id[]', $image->id) }}
                {{ Form::text('image_description[]', $image->description, ['class' => 'form-control', 'placeholder' => 'Описание']) }}
            </div>
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label text-danger-800">
                        <input type="checkbox" class="form-check-input" value="{{ $image->id }}" name="image_delete[]">
                        Удалить
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>