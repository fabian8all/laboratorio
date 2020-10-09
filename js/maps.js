var map;
var markers = [];
var drag_marker;

var pinImage1 = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|FE7569",
    new google.maps.Size(21, 34),
    new google.maps.Point(0,0),
    new google.maps.Point(10, 34));
var redmark = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|FF0000",
    new google.maps.Size(21, 34),
    new google.maps.Point(0,0),
    new google.maps.Point(10, 34));
var greenmark = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|00FF00",
    new google.maps.Size(21, 34),
    new google.maps.Point(0,0),
    new google.maps.Point(10, 34));
var bluemark = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|0000FF",
    new google.maps.Size(21, 34),
    new google.maps.Point(0,0),
    new google.maps.Point(10, 34));
var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
    new google.maps.Size(40, 37),
    new google.maps.Point(0, 0),
    new google.maps.Point(12, 35));

function obtCoor(marker) {
    $('#txt_lat').val(marker.getPosition().lat());
    $('#txt_lng').val(marker.getPosition().lng());
}

function initialize_map(lat ,lng ) {

    lat = typeof lat !== 'undefined' ?  lat : 19.273404633627873;
    lng = typeof lng !== 'undefined' ?  lng : -103.73044727498791;
    var myLatlng = new google.maps.LatLng(lat,lng);
    var myOptions = {
        zoom: 12,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    drag_marker = new google.maps.Marker({
        position: myLatlng,
        draggable: true,
        title: "Chia Crunch"
    });
    google.maps.event.addListener(drag_marker, "dragend", function () {
        obtCoor(drag_marker);
    });

    drag_marker.setMap(map);
    obtCoor(drag_marker);

}

function busca_dir(dir){
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({ 'address': dir}, geocodeResult);
}

function geocodeResult(results, status) {
    if (status == 'OK') {

        var mapOptions = {
            center: results[0].geometry.location,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        // map = new google.maps.Map($("#map_canvas").get(0), mapOptions);

        map.fitBounds(results[0].geometry.viewport);

        var markerOptions = { position: results[0].geometry.location, draggable:true };

        remove_all_markers();

        drag_marker = new google.maps.Marker(markerOptions);

        google.maps.event.addListener(drag_marker, "dragend", function () {
            obtCoor(drag_marker);
        });

        drag_marker.setMap(map);

        obtCoor(drag_marker);
    } else {

        customAlert("Error","Geocoding no tuvo éxito debido a: " + status);
    }
}

function set_marker(data,color){
    if (color == null || color == 'undefined')
        color = pinImage1;
    else
        switch (color){
            case 'red':
                color = redmark;
                break;
            case 'green':
                color = greenmark;
                break;
            case 'blue':
                color = bluemark;
                break;
            default:
                color = pinImage1;
        }
    data = $.parseJSON(data);

    var lat = data.latitud;
    var lng = data.longitud;
    var title = data.title;

    var myLatlng = new google.maps.LatLng(lat,lng);

    var infowindow = new google.maps.InfoWindow({
        content: data.info
    });

    marker = new google.maps.Marker({
        position: myLatlng,
        draggable: false,
        icon: color,
        shadow: pinShadow,
        title: title,
        customInfo:infowindow
    });

    marker.setMap(map);
    markers.push(marker);

    $.each(markers,function (i,marker) {
        google.maps.event.addListener(marker, 'click', function () {
            marker.customInfo.open(map, marker);
        });
    });

}


function fit_markers() {
    if (markers.length > 0) {
        var bounds = new google.maps.LatLngBounds();

        for (var i = 0; i < markers.length; i++) {
            bounds.extend(markers[i].getPosition());
        }

        map.fitBounds(bounds);
    }
}

function remove_marker(marker){
    marker.setMap(null);
}

function remove_all_markers(){
    remove_marker(drag_marker);
    $.each(markers,function(a,b){
        remove_marker(b);
    });
    markers = [];
}