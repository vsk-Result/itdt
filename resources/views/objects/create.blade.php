@extends('layouts.app')

@section('title', 'Объекты - Новый объект')
@section('page-title', 'Объекты - Новый объект')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-md-flex">
                        <ul class="nav nav-tabs nav-tabs-vertical flex-column mr-md-3 wmin-md-250 mb-md-0 border-bottom-0">
                            <li class="nav-item"><a href="#vertical-left-tab1" class="nav-link active" data-toggle="tab"><i class="icon-menu7 mr-2"></i> Основная информация</a></li>
                            <li class="nav-item"><a href="#vertical-left-tab2" class="nav-link" data-toggle="tab"><i class="icon-mention mr-2"></i> Руководители</a></li>
                            <li class="nav-item"><a href="#vertical-left-tab2" class="nav-link" data-toggle="tab"><i class="icon-mention mr-2"></i> Галерея</a></li>
                        </ul>

                        <div class="tab-content w-100">
                            <div class="tab-pane fade show active" id="vertical-left-tab1">
                                <h3 class="font-weight-semibold">Основная информация</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-body" style="box-shadow: 0 1px 2px rgba(0,0,0,.2);    border-top: 2px solid #ccc;">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Заголовок">
                                            </div>
                                            <div class="form-group">
                                                <textarea rows="5" cols="5" class="form-control" placeholder="Контент"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="file">
                                            </div>
                                        </div>
                                        
                                        <div class="create-zone mt-3">
                                            <div class="cz-message"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="vertical-left-tab2">
                                Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
                            </div>

                            <div class="tab-pane fade" id="vertical-left-tab3">
                                DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
                            </div>

                            <div class="tab-pane fade" id="vertical-left-tab4">
                                Aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthet.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection