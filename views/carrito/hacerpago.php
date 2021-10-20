<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancelar pedido</title>
</head>

<body>
    <?php if (isset($_SESSION['cerrado'])) : ?>
        <h1>POR EL MOMENTO NO ESTAMOS PRESTANDO SERVICIOS</h1>
        <center>
            <h3>Nuestros horarios de atencion son los 7 dias de la semana de 6:30AM a 5:00PM</h3>
            <br />
            <img width="250px" src="<?= base_url ?>assets/img/advertencia1.png" />
        </center>
    <?php else : ?> <?php $stats = Utils::statscarrito() ?>
        <h1>DATOS DE CLIENTE</h1>
        <div class="product">
            <?php if ($_SESSION['identity']->imagen != null) : ?>
                <img height="250px" width="150px" src="data:image/jpg;base64,<?php echo base64_encode($_SESSION['identity']->imagen) ?>" />
            <?php else : ?>
                <img height="200px" width="125px" src="<?= base_url ?>assets/img/usuario.png" alt="Camiseta logo" />
            <?php endif; ?>
        </div>
        <div id="detail-product">
            <p>
                <h4>Nombre:</h4> <?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellido ?>
            </p>
            <p>
                <h4>Teléfono:</h4> <?= $_SESSION['identity']->telefono ?>
            </p>
            <p>
                <h4>Correo E-Mail:</h4><?= $_SESSION['identity']->correonormal ?>
            </p>
            <p>
                <h4>Latitud de Ubicación:</h4> <?= $_SESSION['identity']->latitud ?>
            </p>
            <p>
                <h4>Longitud de Ubicación:</h4><?= $_SESSION['identity']->longitud ?>
            </p>
        </div>
        <br /><br /><br /><br />
        <a type="submit" href="<?= base_url ?>index.php?controlador=usuario&accion=editar&id=<?= $_SESSION['identity']->idcliente ?>&cambiar=ubi" class="button button-small">Otra Ubicacion</a>
        <a href=" <?= base_url ?>index.php?controlador=carrito&accion=index" class="button button-small">Salir</a>

        <h1>DATOS DE PEDIDO Y FORMAS DE PAGO</h1>
        <h4>Productos Individuales : <?= $stats['productos'] ?></h4>
        <h4>Unidades Totales : <?= $stats['unidades'] ?></h4>
        <h4>Total a cancelar : $<?= $stats['total'] ?></h4>

        <form action="<?= base_url ?>index.php?controlador=carrito&accion=canceladopaypal&carrito=si" method="POST">
            <button class="boton">Pagar con Paypal</button>
        </form>
        <form action="<?= base_url ?>index.php?controlador=carrito&accion=pagaralrecibir" method="POST">
            <button class="boton">Pagar al recibir</button>
        </form>
        <br /><br /><br /><br />
    <?php endif; ?>
    <?php Utils::deleteSession('cerrado'); ?>
</body>

</html>