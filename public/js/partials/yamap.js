ymaps.ready(init);
function init(){
    var address = $('#object-address').text();
    var geocoder = new ymaps.geocode(
        address,
        { results: 1 }
    );
    geocoder.then(
        function (res) {
            var coord = res.geoObjects.get(0).geometry.getCoordinates();
            var map = new ymaps.Map('map', {
                center: coord,
                zoom: 7,
                behaviors: ['default', 'scrollZoom'],
                controls: ['mapTools']
            });
            map.geoObjects.add(res.geoObjects.get(0));
            map.zoomRange.get(coord).then(function(range){
                map.setCenter(coord, range[1] - 1)
            });
            map.controls.add('mapTools')
                .add('zoomControl')
                .add('typeSelector');
        }
    );
}