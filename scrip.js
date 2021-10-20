function iniciarMap() {//funcion para iniciar el mapa
    var coord = { lat: 13.6363942364915, lng: -88.78698781212542 };//coordenadas por defecto
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10, //resolucion del mapa
        center: coord //posicion del marcador
    });//aqui se construyen los elementos del mapa
    var marker = new google.maps.Marker({
        position: coord,//posicion del marcador
        map: map,
        draggable: true,//el marcador se puede mover
        animation: google.maps.Animation.DROP//animacion del marcador
    });//creamos el marcador

    marker.addListener('click', toggleBounce);//para que el marcador salte con el evento click

    marker.addListener('dragend', function (event) {//evento de arrastrar
        //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
        document.getElementById("coordsLa").value = this.getPosition().lat();
        document.getElementById("coordsLo").value = this.getPosition().lng();
    });
}

function toggleBounce() {//funcion para la animacion que lleva el marcador
    if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
    } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
    }
}