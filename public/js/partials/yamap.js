
ymaps.ready(init);

var bigMap;
var smallMap;
var balloon;
var coord;

function init() {
    var address = $('#object-address').text();
    var geocoder = new ymaps.geocode(
        address,
        { results: 1 }
    );
    geocoder.then(function (res) {
        coord = res.geoObjects.get(0).geometry.getCoordinates();
    });

    setTimeout(function() {
        $('#map').css('height', (document.body.clientHeight * 0.7) + 'px');

        smallMap = new ymaps.Map('mini', {
            center: coord,
            zoom: 17
        });

        smallMap.behaviors.disable('drag');
        bigMap = new ymaps.Map('map', {
            center: coord,
            zoom: 17,
            // behaviors: ['default', 'scrollZoom'],
            // controls: ['mapTools']
        });

        balloon = new ymaps.Placemark(coord, {
            balloonContentHeader: "Балун метки",
            balloonContentBody: "Содержимое <em>балуна</em> метки",
            balloonContentFooter: "Подвал",
            hintContent: "Хинт метки"
        });

        smallMap.geoObjects.add(balloon);
        // smallMap.zoomRange.get(coord).then(function(range){
        //     smallMap.setCenter(coord, range[1] - 1)
        // });
    }, 1000);
}

$('#mini').on('click', function() {
    $('#objectMap').modal('show');
    bigMap.geoObjects.add(balloon);
    // bigMap.zoomRange.get(coord).then(function(range){
    //     bigMap.setCenter(coord, range[1] - 1)
    // });
});

$("#objectMap").on('hidden.bs.modal', function(){
    smallMap.geoObjects.add(balloon);
    // smallMap.zoomRange.get(coord).then(function(range){
    //     smallMap.setCenter(coord, range[1] - 1)
    // });
});