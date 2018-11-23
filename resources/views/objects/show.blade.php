@extends('layouts.app')

@section('title', 'Объект ' . $object->getFullName())
@section('page-title', 'Объект ' . $object->getFullName())

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <ul id="imageGallery" >
                            <li data-thumb="https://storge.pic2.me/c/1360x800/423/52c1ee0032112.jpg" data-src="https://storge.pic2.me/c/1360x800/423/52c1ee0032112.jpg">
                                <img class="card-img img-fluid" src="https://storge.pic2.me/c/1360x800/423/52c1ee0032112.jpg" />
                            </li>
                            <li data-thumb="https://storge.pic2.me/c/1360x800/423/52c1ee0032112.jpg" data-src="https://storge.pic2.me/c/1360x800/423/52c1ee0032112.jpg">
                                <img class="card-img img-fluid" src="https://storge.pic2.me/c/1360x800/423/52c1ee0032112.jpg" />
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card card-body">
                    <div class="media align-items-center align-items-md-start flex-column flex-md-row">
                        <a href="#" class="text-teal mr-md-3 mb-3 mb-md-0">
                            <i class="icon-question7 text-success-400 border-success-400 border-2 rounded-round p-2"></i>
                        </a>

                        <div class="media-body text-center text-md-left">
                            <h5 class="media-title font-weight-semibold">Показать на карте</h5>
                            Google map
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body text-center card-img-top" style="background-image: url(http://demo.interface.club/limitless/assets/images/bg.png); background-size: contain;">
                        <div class="card-img-actions d-inline-block mb-3">
                            <img class="img-fluid rounded-circle" src="http://demo.interface.club/limitless/demo/bs4/Template/global_assets/images/demo/users/face1.jpg" width="170" height="170" alt="">
                        </div>

                        <h6 class="font-weight-semibold mb-0">Богданович Зоран</h6>
                        <span class="d-block opacity-75">Главный инженер проекта</span>
                    </div>

                    <div class="card-body border-top-0">

                        <div class="d-sm-flex flex-sm-wrap mb-3">
                            <div class="font-weight-semibold">Телефон:</div>
                            <div class="ml-sm-auto mt-2 mt-sm-0">+7 999-99-99</div>
                        </div>

                        <div class="d-sm-flex flex-sm-wrap mb-3">
                            <div class="font-weight-semibold">Email:</div>
                            <div class="ml-sm-auto mt-2 mt-sm-0"><a href="#">zoran@zoran.com</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-weight-semibold">Overview</h3>
                        <p class="mb-3">Then sluggishly this camel learned woodchuck far stretched unspeakable notwithstanding the walked owing stung mellifluously glumly rooster more examined one that combed until a less less witless pouted up voluble timorously glared elaborate giraffe steady while grinned and got one beaver to walked. Connected picked rashly ocelot flirted while wherever unwound much more one inside emotionally well much woolly amidst upon far burned ouch sadistically became.</p>

                        <h3 class="font-weight-semibold">What we need</h3>
                        <p class="mb-4">Some cow goose out and sweeping wow the skillfully goodness one crazily far some jeez darn well so peevish pending nudged categorically in between about much alas handsome intolerable devotedly helpfully smiled momentously next much this this next sweepingly far. Together prim and limpet much extravagantly quail longing a ouch that walking a jeepers flamingo more.</p>

                        <div class="row container-fluid">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <dl>
                                        <dt class="font-size-sm text-primary text-uppercase">1. Salamander much that on much</dt>
                                        <dd>Like partook magic this enthusiastic tasteful far crud otter this the ferret honey iguana.</dd>

                                        <dt class="font-size-sm text-primary text-uppercase">2. Well far some raccoon</dt>
                                        <dd>Python laudably euphemistically since this copious much human this briefly hello ouch less one diligent however impotently made gave a slick up much.</dd>

                                        <dt class="font-size-sm text-primary text-uppercase">3. Goldfish rapidly that far</dt>
                                        <dd>Well far some raccoon knew goose and crud behind salmon amenable oh the poignant sufficiently yikes a naked showed far reindeer imminently.</dd>
                                    </dl>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-4">
                                    <dl>
                                        <dt class="font-size-sm text-primary text-uppercase">1. Misunderstood cuffed more depending</dt>
                                        <dd>And earthworm dear arose bald agilely sad so below cowered within ceremonially therefore via much this symbolically and newt capably.</dd>

                                        <dt class="font-size-sm text-primary text-uppercase">2. Voluble much saddled mechanic</dt>
                                        <dd>Much took between less goodness jay mallard kneeled gnashed this up strong cooperative.</dd>

                                        <dt class="font-size-sm text-primary text-uppercase">3. Before some one more</dt>
                                        <dd>Pending some contrary rabbit up that the more conditionally ouch confidently far so was darn logic thus dove the juicily because that placed otter.</dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <h3 class="font-weight-semibold">Requirements</h3>
                        <p class="mb-3">So slit more darn hey well wore submissive savage this shark aardvark fumed thoughtfully much drank when angelfish so outgrew some alas vigorously therefore warthog superb less oh groundhog less alas gibbered barked some hey despicably with aesthetic hamster jay by luckily.</p>

                        <div class="card card-table table-responsive shadow-0">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Task</th>
                                    <th>Due date</th>
                                    <th>Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><span class="font-weight-semibold">Design mockup</span></td>
                                    <td>
                                        <div class="d-inline-flex align-items-center">
                                            <i class="icon-calendar2 mr-2"></i>
                                            <input type="text" class="form-control datepicker p-0 border-0 bg-transparent hasDatepicker" value="21 January, 15" id="dp1542972541968">
                                        </div>
                                    </td>
                                    <td>Create design mockups for a new app, must be delivered before 1st of March</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><span class="font-weight-semibold">User interface research</span></td>
                                    <td>
                                        <div class="d-inline-flex align-items-center">
                                            <i class="icon-calendar2 mr-2"></i>
                                            <input type="text" class="form-control datepicker p-0 border-0 bg-transparent hasDatepicker" value="24 January, 15" id="dp1542972541969">
                                        </div>
                                    </td>
                                    <td>Create a focus group with random people, provide a research statement</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><span class="font-weight-semibold">New icons set</span></td>
                                    <td>
                                        <div class="d-inline-flex align-items-center">
                                            <i class="icon-calendar2 mr-2"></i>
                                            <input type="text" class="form-control datepicker p-0 border-0 bg-transparent hasDatepicker" value="28 January, 15" id="dp1542972541970">
                                        </div>
                                    </td>
                                    <td>Create a full set of icons required for the iOS application, send them to team lead for review</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><span class="font-weight-semibold">Loading optimization</span></td>
                                    <td>
                                        <div class="d-inline-flex align-items-center">
                                            <i class="icon-calendar2 mr-2"></i>
                                            <input type="text" class="form-control datepicker p-0 border-0 bg-transparent hasDatepicker" value="1 February, 15" id="dp1542972541971">
                                        </div>
                                    </td>
                                    <td>Review image sizes, compress them as much as possible, make sure page loading time is less than 1 second</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <h3 class="font-weight-semibold">Uploaded files</h3>
                        <p>A much goodness between destructive that save stupid firefly destructively dog goldfinch continually alas pinched for outside flailed inescapably hey brought rid crud and awakened sobbed extraordinarily wherever deer before tenable yet into dalmatian opposite save close ahead next independent mindful but far.</p>

                        <div class="row">
                            <div class="col-xl-3 col-sm-6">
                                <div class="card">
                                    <div class="card-img-actions mx-1 mt-1">
                                        <img class="card-img img-fluid" src="../../../../global_assets/images/demo/flat/9.png" alt="">
                                        <div class="card-img-actions-overlay card-img">
                                            <a href="../../../../global_assets/images/demo/flat/9.png" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox" rel="group">
                                                <i class="icon-zoomin3"></i>
                                            </a>

                                            <a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
                                                <i class="icon-download"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="d-flex align-items-start flex-wrap">
                                            <div class="font-weight-semibold">dashboard_draft.png</div>
                                            <span class="font-size-sm text-muted ml-auto">378Kb</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="card">
                                    <div class="card-img-actions mx-1 mt-1">
                                        <img class="card-img img-fluid" src="../../../../global_assets/images/demo/flat/8.png" alt="">
                                        <div class="card-img-actions-overlay card-img">
                                            <a href="../../../../global_assets/images/demo/flat/9.png" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox" rel="group">
                                                <i class="icon-zoomin3"></i>
                                            </a>

                                            <a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
                                                <i class="icon-download"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="d-flex align-items-start flex-wrap">
                                            <div class="font-weight-semibold">profile_page.png</div>
                                            <span class="font-size-sm text-muted ml-auto">1.2Mb</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="card">
                                    <div class="card-img-actions mx-1 mt-1">
                                        <img class="card-img img-fluid" src="../../../../global_assets/images/demo/flat/6.png" alt="">
                                        <div class="card-img-actions-overlay card-img">
                                            <a href="../../../../global_assets/images/demo/flat/9.png" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox" rel="group">
                                                <i class="icon-zoomin3"></i>
                                            </a>

                                            <a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
                                                <i class="icon-download"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="d-flex align-items-start flex-wrap">
                                            <div class="font-weight-semibold">shopping_cart.png</div>
                                            <span class="font-size-sm text-muted ml-auto">1.8Mb</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="card">
                                    <div class="card-img-actions mx-1 mt-1">
                                        <img class="card-img img-fluid" src="../../../../global_assets/images/demo/flat/12.png" alt="">
                                        <div class="card-img-actions-overlay card-img">
                                            <a href="../../../../global_assets/images/demo/flat/9.png" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round" data-popup="lightbox" rel="group">
                                                <i class="icon-zoomin3"></i>
                                            </a>

                                            <a href="#" class="btn btn-outline bg-white text-white border-white border-2 btn-icon rounded-round ml-2">
                                                <i class="icon-download"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="d-flex align-items-start flex-wrap">
                                            <div class="font-weight-semibold">sales_statistics.png</div>
                                            <span class="font-size-sm text-muted ml-auto">2.0Mb</span>
                                        </div>
                                    </div>
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
    <link href="{{ asset('vendors/lightslider/dist/css/lightslider.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('vendors/lightGallery/dist/js/lightgallery.min.js') }}"></script>
    <script src="{{ asset('vendors/lightslider/dist/js/lightslider.min.js') }}"></script>
    <!-- Theme JS files -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbF9O9Ks9_-QNWHi2SFxLqLUBOwrMyzXk"></script>
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

        /* ------------------------------------------------------------------------------
 *
 *  # Basic map
 *
 *  Specific JS code additions for maps_google_basic.html page
 *
 * ---------------------------------------------------------------------------- */


        // Setup module
        // ------------------------------

        var GoogleMapBasic = function() {


            //
            // Setup module components
            //

            // Line chart
            var _googleMapBasic = function() {
                if (typeof google == 'undefined') {
                    console.warn('Warning - Google Maps library is not loaded.');
                    return;
                }

                // Map settings
                function initialize() {

                    // Define map element
                    var map_basic_element = document.getElementById('map_basic');

                    // Optinos
                    var mapOptions = {
                        zoom: 12,
                        center: new google.maps.LatLng(47.496, 19.037)
                    };

                    // Apply options
                    var map = new google.maps.Map(map_basic_element, mapOptions);
                }

                // Load map
                google.maps.event.addDomListener(window, 'load', initialize);
            };


            //
            // Return objects assigned to module
            //

            return {
                init: function() {
                    _googleMapBasic();
                }
            }
        }();


        // Initialize module
        // ------------------------------

        document.addEventListener('DOMContentLoaded', function() {
            GoogleMapBasic.init();
        });
    </script>
@endpush