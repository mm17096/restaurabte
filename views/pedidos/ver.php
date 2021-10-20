<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Carrito de Compra</title>
</head>

<body>

    <h1>INFORMACION DEL CLIENTE Y SU PEDIDO</h1>
    <?php if (isset($_SESSION['emp'])) : ?>
        <a href=" <?= base_url ?>index.php?controlador=empresa&accion=ver&id=<?= $idempresa; ?>" class="button button-small">Regresar</a>
    <?php endif; ?>

    <?php if (isset($_SESSION['user'])) : ?>
        <a href="<?= base_url ?>index.php?controlador=pedido&accion=pedidoscliente&id=<?= $iduser ?>&tipo=gestion" class="button button-small">Regresar</a>
    <?php endif; ?>

    <?php if (isset($_SESSION['gestion'])) : ?>
        <a href=" <?= base_url ?>index.php?controlador=pedido&accion=gestionar&tipo=Pendiente" class="button button-small">Salir</a>
    <?php endif; ?>
    <?php Utils::deleteSession('emp'); ?>
    <?php Utils::deleteSession('user'); ?>
    <div class="product">
        <?php if ($cliente->imagen != null) : ?>
            <img height="200px" width="125px" src="data:image/jpg;base64,<?php echo base64_encode($cliente->imagen) ?>" />
        <?php else : ?>
            <img height="200px" width="125px" src="<?= base_url ?>assets/img/usuario.png" alt="Camiseta logo" />
        <?php endif; ?>
    </div>
    <h4>Nombre:</h4>
    <p>
        <?= $cliente->nombre ?> <?= $cliente->apellido ?>
    </p>

    <h4>Correo E-Mail:</h4>
    <p>
        <?= $cliente->correonormal ?>
    </p>
<?php if($orden->tipodepago == 'paypal'): ?>
    <h4>Correo PayPal:</h4>
    <p>
        <?= $orden->correopaypal ?>
    </p>
<?php endif; ?>
    <h4>Latitud de Ubicación:</h4>
    <p>
        <?= $orden->latitud ?>
    </p>

    <h4>Longitud de Ubicación:</h4>
    <p>
        <?= $orden->longitud ?>
    </p>
    <br /><br /><br /><br /><br /><br />
    <a href=" <?= base_url ?>crearPdf.php?fecha=<?=$orden->fecha?>&total=<?=$orden->costototal?>&hora=<?=$orden->hora?>&dui=<?=$cliente->dui?>&correo=<?=$cliente->correonormal?>" class="button button-small">Generar Ticket</a>
    <?php if($orden->estado == 'Pendiente'): ?>
    <a href=" <?= base_url ?>index.php?controlador=pedido&accion=negar&ido=<?= $orden->idorden ?>&idc=<?= $cliente->idcliente ?>" class="button button-small">Negar Pedido</a>
     <?php endif; ?>   
    <h1>PEDIDO</h1>
    <h3>Total: $<?= $orden->costototal ?></h3>
    <table>

        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Cantidad</th>
        </tr>

        <?php while ($detalle = $detalles->fetch_object()) : ?>
            <tr>
                <td>
                    <img height="80px" src="data:image/jpg;base64,<?php echo base64_encode($detalle->imagen) ?>" />
                </td>
                <td><?= $detalle->nombre; ?></td>
                <td><?= $detalle->precio; ?></td>
                <td><?= $detalle->cantidad; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br /><br />
    <center>
        <div id="map">
            <iframe width="50%" height="550px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="ubicacion.php?latitud=<?= $orden->latitud ?>&longitud=<?= $orden->longitud ?>">
        </div>
    </center>
    <br /><br />
</body>


</html>