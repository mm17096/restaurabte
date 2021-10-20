<!DOCTYPE html>
<html>

<head>
    <title>Mapas</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
  </head>

<body>
    <div id="map"></div>
    <input type="text" id="coordsLa" value="<?= $_GET['latitud'] ?>" />
    <input type="text" id="coordsLo" value="<?= $_GET['longitud'] ?>" />
    <script src="scrip2.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTbILPSKDXqmVsxb94nxYWpnSBQfoZO6k&callback=iniciarMap&libraries=&v=weekly" defer></script>
</body>

</html>