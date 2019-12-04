@extends('layouts.app')

@section('title', 'Объекты - Новый объект')
@section('page-title', 'Объекты - Новый объект')

@section('header-elements')
    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a id="add-object" href="#" title="Добавить объект" class="btn btn-sm bg-primary-400 btn-icon rounded-round">
                <i class="icon-checkmark2"></i>
            </a>
        </div>
    </div>
@endsection

@section('content')

    @include('knowledge.partials.icon_list')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex">
                        {{ Form::open(['url' => route('objects.store'), 'id' => 'infopartForm', 'files' => true, 'method' => 'POST', 'style' => 'display:contents;'] ) }}
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
                                            <input type="text" name="code" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Название</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Адрес</label>
                                            <input type="text" name="address" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Главное изображение</label>
                                            <input type="file" name="image" class="form-control fileuplouder-single">
                                        </div>

                                        <h3 class="font-weight-semibold">Блоки информации</h3>

                                        <div class="infoparts"></div>

                                        <div class="create-zone mt-3">
                                            <div class="cz-message add-infopart" data-create-url="{{ route('objects.create_infopart') }}"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="vertical-left-tab2">
                                <h3 class="font-weight-semibold">Ответственные лица</h3>

                                <div class="persons"></div>

                                <div class="create-zone mt-3">
                                    <div class="cz-message add-person" data-create-url="{{ route('objects.create_person') }}"></div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="vertical-left-tab3">
                                <h3 class="font-weight-semibold">Галерея</h3>

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
    <link href="{{ asset('vendors/fileuploader/src/jquery.fileuploader.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/fileuploader/src/css/jquery.fileuploader-theme-onebutton.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/summernote/summernote.css') }}" rel="stylesheet">
    <style>
        .fileuploader-items .fileuploader-item .fileuploader-action.fileuploader-action-remove i {
            font-family: icomoon !important;
        }
        .fileuploader-items .fileuploader-item .fileuploader-action.fileuploader-action-remove i:before {
            content: "\ed6b";
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('vendors/fileuploader/src/jquery.fileuploader.min.js') }}"></script>
    <script src="{{ asset('vendors/summernote/summernote.min.js') }}"></script>
    <script>
        $(document).ready(function() {
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
            initialize();
        });

        $('#add-object').on('click', function () {
           $('#infopartForm').submit();
        });

        $('.add-infopart').on('click', function () {
            var url = $(this).data('create-url');
            $.ajax({
                url:url
            }).done(function(data) {
                $('.infoparts').append(data.infopart_render);
            }).always(function () {
                initialize();
            });
        });

        $('.add-person').on('click', function () {
            var url = $(this).data('create-url');
            $.ajax({
                url:url
            }).done(function(data) {
                $('.persons').append(data.person_render);
            }).always(function () {
                initialize();
            });
        });

        function initialize() {
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

        $('body').on('click', '.icons-container i', function () {
            var icon = $(this);
            var parent = icon.closest('.card-body');
            var icons_container = parent.find('.icons-container');
            var input_icon = parent.find('.input-icon');
            var button_icon = parent.find('.choose-icon i');

            input_icon.val(icon.data('id'));
            button_icon.attr('class', icon.attr('class') + ' mr-2').removeClass('icon-2x');
            icons_container.html('').hide();
        });

        $('body').on('click', '.choose-icon', function () {
            var button = $(this);
            var parent = button.closest('.card-body');
            var icons_container = parent.find('.icons-container');

            if (icons_container.is(":visible")) {
                icons_container.html('').hide();
            } else {
                icons_container.html($('#our-icon-list').html()).show();
            }
        });
    </script>
@endpush
