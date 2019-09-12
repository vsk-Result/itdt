
ymaps.ready(init);

var bigMap;
var smallMap;
var balloon;
var coord;

function init(){
    var address = $('#object-address').text();
    var geocoder = new ymaps.geocode(
        address,
        { results: 1 }
    );
    geocoder.then(
        function (res) {

            $('#map').css('height', (document.body.clientHeight * 0.7) + 'px');

            coord = res.geoObjects.get(0).geometry.getCoordinates();

            smallMap = new ymaps.Map('mini', {
                center: coord,
                zoom: 7,
                behaviors: ['default', 'scrollZoom'],
                controls: ['mapTools']
            });
            bigMap = new ymaps.Map('map', {
                center: coord,
                zoom: 7,
                behaviors: ['default', 'scrollZoom'],
                controls: ['mapTools']
            });
            balloon = res.geoObjects.get(0);

            smallMap.geoObjects.add(balloon);
            smallMap.zoomRange.get(coord).then(function(range){
                smallMap.setCenter(coord, range[1] - 1)
            });
        }
    );
}

$('#mini').on('click', function() {
    $('#objectMap').modal('show');
    bigMap.geoObjects.add(balloon);
    bigMap.zoomRange.get(coord).then(function(range){
        bigMap.setCenter(coord, range[1] - 1)
    });
});

$("#objectMap").on('hidden.bs.modal', function(){
    smallMap.geoObjects.add(balloon);
    smallMap.zoomRange.get(coord).then(function(range){
        smallMap.setCenter(coord, range[1] - 1)
    });
});