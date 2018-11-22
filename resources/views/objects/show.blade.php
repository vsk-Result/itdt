@extends('layouts.app')

@section('title', 'Объект ' . $object->getFullName())
@section('page-title', 'Объект ' . $object->getFullName())

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <ul id="imageGallery" >
                        <li data-thumb="https://storge.pic2.me/c/1360x800/423/52c1ee0032112.jpg" data-src="https://storge.pic2.me/c/1360x800/423/52c1ee0032112.jpg">
                            <img src="https://storge.pic2.me/c/1360x800/423/52c1ee0032112.jpg" />
                        </li>
                        <li data-thumb="https://storge.pic2.me/c/1360x800/423/52c1ee0032112.jpg" data-src="https://storge.pic2.me/c/1360x800/423/52c1ee0032112.jpg">
                            <img src="https://storge.pic2.me/c/1360x800/423/52c1ee0032112.jpg" />
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-md-4">

        </div>
    </div>
@endsection

@push('css')
    <link href="{{ asset('vendors/lightGallery/dist/css/lightgallery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendors/lightslider/dist/css/lightslider.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('vendors/lightGallery/dist/js/lightgallery.min.js') }}"></script>
    <script src="{{ asset('vendors/lightslider/dist/js/lightslider.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#imageGallery').lightSlider({
                gallery:true,
                item:1,
                loop:true,
                thumbItem:9,
                slideMargin:0,
                enableDrag: false,
                currentPagerPosition:'left',
                onSliderLoad: function(el) {
                    el.lightGallery({
                        selector: '#imageGallery .lslide'
                    });
                }
            });
        });
    </script>
@endpush