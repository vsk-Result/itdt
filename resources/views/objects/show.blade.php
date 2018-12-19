@extends('layouts.app')

@section('title', 'Объект ' . $object->getFullName())
@section('page-title', 'Объект ' . $object->getFullName())

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-4">
                @include('objects.partials.task_info')
                @each('objects.partials.person', $object->persons, 'person')
            </div>
            <div class="col-md-8">
                <div class="card card-body">
                    <h3 class="font-weight-semibold">Основная информация</h3>
                    <p>Башня "Эволюция" является одним из самых ярких элементов среди всех составляющих комплекса "Москва-Сити". Закрученная форма, напоминающая спираль ДНК, задумывалась архитекторами не напрасно. Это символизирует вечность, эволюцию всего живого, существующего на нашей планете. Каждый верхний этаж повернут относительно нижнего на три градуса - так образуется спираль. Половину оборота вокруг собственной оси небоскреб совершает на уровне 51 этажа. Именно благодаря этой легкости, с которой башня поворачивается, и создается ощущение бесконечности движения, эволюции сознания, поиска совершенства.</p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a data-toggle="collapse" class="text-default collapsed" href="#provider" aria-expanded="false">
                                        Провайдер
                                    </a>
                                </h3>
                            </div>
                            <div id="provider" class="collapse">
                                <div class="card-body">
                                    <p>ЭНФОРТА</p>
                                    <p><a href="mailto:https://www.enforta.ru">https://www.enforta.ru</a></p>
                                    <p>ООО "Строй Техно Инженеринг"</p>
                                    <hr>
                                    <p>Офис на "Красный Октябрь"</p>
                                    <p>Москва, Россия, 119072, Берсеневский переулок, 2с1</p>
                                    <p>IP: 31.200.222.254</p>
                                    <p>Маска:  255.255.255.252</p>
                                    <p>Шлюз: 31.200.222.253</p>
                                    <p>DNS: 87.241.223.68; 81.17.2.171</p>
                                    <hr>
                                    <p>Local: 172.23.23.1</p>
                                    <p>DHCP: 172.23.23.10-172.23.23.254</p>
                                    <hr>
                                    <p>Вагончики на стройке</p>
                                    <p>Москва, Россия, 119072, Болотная набережная, 15к1,</p>
                                    <p>IP: 46.52.181.174</p>
                                    <p>Маска:  255.255.255.224</p>
                                    <p>Шлюз: 46.52.181.173</p>
                                    <p>DNS: 87.241.223.68; 81.17.2.171</p>
                                    <hr>
                                    <p>Local: 172.24.24.1</p>
                                    <p>DHCP: 172.24.24.10-172.24.24.254</p>
                                    <hr>
                                    <p>Договор № MSK11251 от 26.01.2018 г.</p>
                                    <p>Лицевой счет №  977000894677</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a data-toggle="collapse" class="text-default collapsed" href="#server" aria-expanded="false">
                                        Сервер
                                    </a>
                                </h3>
                            </div>
                            <div id="server" class="collapse">
                                <div class="card-body">
                                    <p>MikroTik_STI_288_420163252 - "Красный Октябрь"</p>
                                    <p>MikroTik_STI_288_420163106 - Вагончики</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ asset('vendors/lightGallery/dist/css/lightgallery.min.css') }}" rel="stylesheet">
    <style>
        p {
            margin-bottom: 0;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('vendors/lightGallery/dist/js/lightgallery.min.js') }}"></script>
    <script src="{{ asset('vendors/lightGallery/modules/lg-thumbnail.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#aniimated-thumbnials').lightGallery({
                thumbnail:true,
                selector: '.card-img-actions'
            });
        });
    </script>
@endpush