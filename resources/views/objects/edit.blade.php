@extends('layouts.app')

@section('title', 'Объекты - Изменение объекта ' . $object->getFullName())
@section('page-title', 'Объекты - Изменение объекта ' . $object->getFullName())

@section('header-elements')
    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a id="edit-object" href="#" title="Добавить объект" class="btn btn-sm bg-primary-400 btn-icon rounded-round">
                <i class="icon-checkmark2"></i>
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex">
                        {{ Form::open(['url' => route('objects.update', $object->id), 'id' => 'infopartForm', 'files' => true, 'method' => 'POST', 'style' => 'display:contents;'] ) }}

                        <ul class="nav nav-tabs nav-tabs-vertical flex-column mr-md-3 wmin-md-250 mb-md-0 border-bottom-0">
                            <li class="nav-item"><a href="#vertical-left-tab1" class="nav-link active" data-toggle="tab"><i class="icon-info3
 mr-2"></i> Информация</a></li>
                            <li class="nav-item"><a href="#vertical-left-tab2" class="nav-link" data-toggle="tab"><i class="icon-people mr-2"></i> Ответственные</a></li>
                            <li class="nav-item"><a href="#vertical-left-tab3" class="nav-link" data-toggle="tab"><i class="icon-gallery mr-2"></i> Галерея</a></li>
                        </ul>

                        <div class="tab-content w-100">
                            <div class="tab-pane fade show active" id="vertical-left-tab1">
                                <div class="row">
                                    <div class="col-md-12">

                                        <h3 class="font-weight-semibold">Основная информация</h3>

                                        <div class="form-group">
                                            <label>Код</label>
                                            {{ Form::text('code', $object->code, ['class' => 'form-control']) }}
                                        </div>

                                        <div class="form-group">
                                            <label>Название</label>
                                            {{ Form::text('name', $object->name, ['class' => 'form-control']) }}
                                        </div>

                                        <div class="form-group">
                                            <label>Адрес</label>
                                            {{ Form::text('address', $object->address, ['class' => 'form-control']) }}
                                        </div>

                                        @if ($object->image)
                                            <label>Изменить главное изображение</label>
                                            <p><a href=""><img class="card-img img-fluid" src="{{ $object->getImageUrl() }}" alt=""></a></p>
                                            <a href="#" class="btn btn-sm bg-danger-400">Удалить</a>
                                        @else
                                            <div class="form-group">
                                                <label>Изменить главное изображение</label>
                                                <input type="file" name="image" class="form-control fileuplouder-single">
                                            </div>
                                        @endif

                                        <hr>
                                        <h3 class="font-weight-semibold">Блоки информации</h3>

                                        <div class="infoparts">
                                            @each('objects.partials.edit_infopart', $object->getInfoParts(), 'infopart')
                                        </div>

                                        <div class="create-zone mt-3">
                                            <div class="cz-message add-infopart" data-create-url="{{ route('objects.create_infopart') }}"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="vertical-left-tab2">
                                <h3 class="font-weight-semibold">Ответственные лица</h3>

                                <div class="persons">
                                    @each('objects.partials.edit_person', $object->persons, 'person')
                                </div>

                                <div class="create-zone mt-3">
                                    <div class="cz-message add-person" data-create-url="{{ route('objects.create_person') }}"></div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="vertical-left-tab3">
                                <h3 class="font-weight-semibold">Галерея</h3>

                                <div class="fileuploader fileuploader-theme-thumbnails pr-0">
                                    <div class="fileuploader-items">
                                        <div class="row b-3">
                                            @each('objects.partials.edit_gallery', $object->images, 'image')
                                        </div>
                                    </div>
                                </div>

                                <input type="file" name="gallery_files[]" multiple="multiple" class="fileuplouder">
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('vendors/lightGallery/dist/css/lightgallery.min.css') }}">
    <link href="{{ asset('vendors/fileuploader/src/jquery.fileuploader.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/fileuploader/src/css/jquery.fileuploader-theme-thumbnails.css') }}" rel="stylesheet">
    <link href="{{ asset('css/partials/fileuploader.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/summernote/summernote.css') }}" rel="stylesheet">
    <style>
        .card-img {
            width: 140px;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('vendors/lightGallery/dist/js/lightgallery.min.js') }}"></script>
    <script src="{{ asset('vendors/lightGallery/modules/lg-fullscreen.min.js') }}"></script>
    <script src="{{ asset('vendors/lightGallery/modules/lg-thumbnail.min.js') }}"></script>
    <script src="{{ asset('vendors/lightGallery/modules/lg-zoom.min.js') }}"></script>
    <script src="{{ asset('vendors/fileuploader/src/jquery.fileuploader.min.js') }}"></script>
    <script src="{{ asset('vendors/summernote/summernote.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            initialize();
            $(".lightgallery").lightGallery({
                selector: '.light-item',
                thumbnail: true,
                zoom: true,
                fullscreen: true
            });
            $('.note-toolbar-wrapper').removeAttr('style');
            $('.note-toolbar').removeAttr('style');
        });

        $('#edit-object').on('click', function () {
            $('#infopartForm').submit();
        });

        $('.add-infopart').on('click', function () {
            var url = $(this).data('create-url');
            $.ajax({
                url:url
            }).done(function(data) {
                $('.infoparts').append(data.infopart_render);
            }).always(function () {
                initializeLast();
            });
        });

        $('.add-person').on('click', function () {
            var url = $(this).data('create-url');
            $.ajax({
                url:url
            }).done(function(data) {
                $('.persons').append(data.person_render);
            }).always(function () {
                initializeLast();
            });
        });

        function initialize() {
            $('.fileuplouder').fileuploader({
                addMore: true,
                theme: 'onebutton',
                captions:
                    {
                        button: function(options) { return 'Выберите ' + (options.limit == 1 ? 'файл' : 'файлы'); },
                    }
            });
            $('.fileuplouder-single').fileuploader({
                limit: 1,
                theme: 'onebutton',
                captions:
                    {
                        button: function(options) { return 'Выберите ' + (options.limit == 1 ? 'файл' : 'файлы'); },
                    }
            });
            $('.summernote').summernote();
            $('.summernote-height').summernote({
                height: 400
            });
            // Air mode
            $('.summernote-airmode').summernote({
                airMode: true
            });
            var files_index = 0;
            $('.infoparts input.fileuplouder').each(function() {
                $(this).attr('name', 'files_' + files_index++ + '[]');
            });
            var files_index = 0;
            $('.persons input.avatar').each(function() {
                $(this).attr('name', 'avatar_' + files_index++);
            });
        }

        function initializeLast() {
            $('.infoparts .card:last .fileuplouder').fileuploader({
                addMore: true,
                theme: 'onebutton',
                captions:
                    {
                        button: function(options) { return 'Выберите ' + (options.limit == 1 ? 'файл' : 'файлы'); },
                    }
            });
            $('.persons .card:last .fileuplouder-single').fileuploader({
                limit: 1,
                theme: 'onebutton',
                captions:
                    {
                        button: function(options) { return 'Выберите ' + (options.limit == 1 ? 'файл' : 'файлы'); },
                    }
            });
            $('.infoparts .card:last .summernote').summernote();
            $('.infoparts .card:last .summernote-height').summernote({
                height: 400
            });
            // Air mode
            $('.infoparts .card:last .summernote-airmode').summernote({
                airMode: true
            });
            var files_index = 0;
            $('.infoparts input.fileuplouder').each(function() {
                $(this).attr('name', 'files_' + files_index++ + '[]');
            });
            var files_index = 0;
            $('.persons input.avatar').each(function() {
                $(this).attr('name', 'avatar_' + files_index++);
            });
        }
    </script>
@endpush
