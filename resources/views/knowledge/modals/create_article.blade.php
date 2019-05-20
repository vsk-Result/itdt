<div id="createArticle" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Новая статья</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                {{ Form::open(['url' => route('knowledge.articles.store'), 'method' => 'POST', 'files' => true]) }}
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" name="link_access" class="form-check-input" value="link_access">
                            Доступ по ссылке
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label>Категория</label>
                    <select name="category_id" class="form-control select-icon">
                        @foreach($categories as $category)
                            <option id="{{ $category->icon->name }}" value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Иконка</label><br>
                            {{ Form::hidden('icon_id', null, ['class' => 'input-icon']) }}
                            <button type="button" class="btn btn-light choose-icon"><i class="mr-2"></i> Выбрать иконку</button>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Название</label>
                            {{ Form::text('title', null, ['class' => 'form-control', 'required' => true]) }}
                        </div>
                    </div>
                </div>

                <div class="icons-container" style="display: none;"></div>

                <div class="form-group">
                    <label>Тэги</label>
                    {{ Form::text('tags', null, ['class' => 'form-control tokenfield']) }}
                </div>
                <div class="form-group">
                    <label>Контент</label>
                    {!! Form::textarea('content', null, ['class' => 'summernote']) !!}
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>