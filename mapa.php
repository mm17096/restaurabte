<!DOCTYPE html>
<html>

<head>
    <title>Mapas</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <script type="text/javascript">
        function selecciona() {
            window.opener.document.getElementById('lat').value = document.getElementById("coordsLa").value;
            window.opener.document.getElementById('lon').value = document.getElementById("coordsLo").value;
            window.close();
        };
    </script>
</head>

<body>
    <div id="map"></div>
    <input type="text" id="coordsLa" />
    <input type="text" id="coordsLo" />
    <input type="button" onclick="selecciona()" value="Obtener" />
    <script src="scrip.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTbILPSKDXqmVsxb94nxYWpnSBQfoZO6k&callback=iniciarMap&libraries=&v=weekly" defer></script>
</body>

</html>