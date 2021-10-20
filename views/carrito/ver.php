<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compra</title>

    <script>
        function alerta() {
            alert('Para realizar la compra el saldo minimo debe ser $15.0');
        }
    </script>
</head>

<body>
    <h1>Carrito de la Compra</h1>
    <a href=" <?= base_url ?>index.php?controlador=producto&accion=index" class="button button-small">Salir</a>
    <a href=" <?= base_url ?>index.php?controlador=carrito&accion=delete" class="button button-small">Vaciar Carrito</a>
    <div class="total-carrito">
        <?php $stats = Utils::statscarrito() ?>
        <h3>Total: $<?= $stats['total'] ?></h3>
        <?php if ($stats['total'] >= 15.0) : ?>
            <?php if (isset($_SESSION['identity'])) : ?>
                <a href=" <?= base_url ?>index.php?controlador=carrito&accion=hacerpago" class=" button button-pedido">Hacer Pedido</a>
            <?php else : ?>
                <a href=" <?= base_url ?>index.php?controlador=carrito&accion=errorsesion" class=" button button-pedido">Hacer Pedido</a>
            <?php endif; ?>
        <?php else : ?>
            <a onclick="alerta()" class=" button button-pedido">Hacer Pedido</a>
        <?php endif; ?>

    </div>
    <?php Utils::deleteSession('error_cantidad') ?>

    <?php if (isset($_SESSION['carrito'])) : ?>
        <table>

            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>

            <?php foreach ($carrito as $index => $elemento) :
                $producto = $elemento['producto'];
            ?>
                <tr>
                    <td>
                        <img height="80px" src="data:image/jpg;base64,<?php echo base64_encode($producto->imagen) ?>" />
                    </td>
                    <td>
                        <?= $producto->nombre ?>
                    </td>
                    <td>
                        <?= $producto->precio ?>
                    </td>
                    <td>
                        <?= $elemento['unidades'] ?>
                    </td>
                    <td>
                        <center>
                            <a href=" <?= base_url ?>index.php?controlador=carrito&accion=add&id=<?= $producto->idproducto ?>" class="button button-gestion">Agregar</a>
                            <a href=" <?= base_url ?>index.php?controlador=carrito&accion=deleteproducto&id=<?= $producto->idproducto ?>" class="button button-gestion button-red">Eiminar</a>
                        </center>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>Carrito vacio</p>
    <?php endif; ?>
    <br /><br />
    <center> <?php if (isset($_SESSION['pedidohecho'])) : ?>
            <?php if ($_SESSION['pedidohecho'] == 'paypal') : ?>
                <br />
                <h3>Su compra en PayPal ha sido exitosa!</h3>
                <h3>Ya se está procesando su pedido</h3>
                <h3>En breve estaremos entregándolo a su ubicación</h3>
                <img height="250px" width="275px" src="<?= base_url ?>assets/img/gracias.png" alt="Camiseta logo" />
            <?php else : ?>
                <br />
                <h3>Ya se está procesando su pedido</h3>
                <h3>En breve estaremos entregándolo a su ubicación</h3>
                <img height="250px" width="275px" src="<?= base_url ?>assets/img/gracias.png" alt="Camiseta logo" />
            <?php endif; ?>
            <?php Utils::deleteSession('pedidohecho') ?>
        <?php endif; ?>
    </center>
    <br /><br /><br />
</body>

</html>