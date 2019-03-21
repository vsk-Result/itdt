<div class="col-md-6">
    <div class="form-group">
        <label class="font-weight-semibold">{{ $image->filename }}</label>
        <div class="media mt-0">
            <div class="mr-3 lightgallery">
                <a href="{{ $image->getUrl() }}" class="light-item">
                    <img src="{{ $image->getUrl() }}" width="120" alt="">
                </a>
            </div>

            <div class="media-body">
                {{ Form::hidden('image_id[]', $image->id) }}
                {{ Form::text('image_description[]', $image->description, ['class' => 'form-control', 'placeholder' => 'Описание']) }}
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