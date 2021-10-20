var latitud = document.getElementById("coordsLa").value;
var longitud = document.getElementById("coordsLo").value;
var lat = 13.6363942364915;
var long = -88.78698781212542;
var mapa;

function iniciarMap() { //funcion para iniciar el mapa
    var coordinicio = new google.maps.LatLng(lat, long);
    var coordfin = new google.maps.LatLng(latitud, longitud);
    mapa = new google.maps.Map(document.getElementById('map'), {
        zoom: 10, //resolucion del mapa
        center: coordinicio //posicion del marcador
    }); //aqui se construyen los elementos del mapa
    var marker = new google.maps.Marker({
        position: coordinicio, //posicion del marcador
        map: mapa,
        draggable: false, //el marcador se puede mover
        animation: google.maps.Animation.DROP //animacion del marcador
    }); //creamos el marcador
    var marker2 = new google.maps.Marker({
        position: coordfin, //posicion del marcador
        map: mapa,
        draggable: false, //el marcador se puede mover
        animation: google.maps.Animation.DROP //animacion del marcador
    }); //creamos el marcador

    var objConfDR = {
        map: mapa,
        suppressMarkers: false
    }

    var objConfDS = {
        origin: coordinicio,
        destination: coordfin,
        travelMode: google.maps.TravelMode.DRIVING
    }

    var ds = new google.maps.DirectionsService(); //obtener coordenadas
    var dr = new google.maps.DirectionsRenderer(objConfDR); //traduce las coordenadas y dibuja la ruta

    ds.route(objConfDS, fnRuter);

    function fnRuter(resultados, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            dr.setDirections(resultados);
        } else {
            alert('Error' + _status);
        }
    }

}