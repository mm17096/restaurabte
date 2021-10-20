<?php 
$correo = $_GET['correo'];
$dui = $_GET['dui'];
$fecha = $_GET['fecha'];
$hora = $_GET['hora'];
$costo = $_GET['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket</title>
</head>

<body>
<center>
<h5>RESTAURANTE QUEVAQUERER</h5>
<h5>Ticket de Pedido</h5>
    <br/>
    <h5> Correo de CLiente :</h5>
    <h5><?= $correo?></h5>
    <h5> DUI de CLiente :</h5>
    <h5> <?= $dui?></h5>
    <h5> Fecha : </h5>
    <h5> <?= $fecha ?> </h5>
    <h5> Hora : </h5>
    <h5> <?= $hora ?> </h5>
    <h5> Costo Total :</h5>
    <h5> $<?= $costo?> </h5>
    <h6> !GRACIAS POR SU PREFERENCIA!</h6>
    </center>
</body>
</html>