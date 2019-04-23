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
                            <label>Иконка</label>
                            <select name="icon_id" class="form-control select-icon">
                                @foreach($icons as $icon)
                                    <option id="{{ $icon->name }}" value="{{ $icon->id }}">{{ $icon->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label>Название</label>
                            {{ Form::text('title', null, ['class' => 'form-control', 'required' => true]) }}
                        </div>
                    </div>
                </div>
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