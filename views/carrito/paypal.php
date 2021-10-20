<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago con Paypal</title>
</head>

<body>
    <form method="POST" action="https://www.sandbox.paypal.com/cgi-bin/webscr">
        <input type="hidden" name="charset" value="utf-8">
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="upload" value="1">
        <input type="hidden" name="business" value="kevineliasmejia@gmail.com">
        <input type="hidden" name="shopping_url" value="<?= base_url ?>index.php?controlador=carrito&accion=index">
        <input type="hidden" name="currency_code" value="USD">
        <input type="hidden" name="return" value="<?= base_url ?>index.php?controlador=carrito&accion=canceladopaypal&idcliente=<?= $_SESSION['identity']->idcliente ?>&idorden=<?= $_GET['id'] ?>">
        <input type="hidden" name="cancel_return" value="<?= base_url ?>index.php?controlador=carrito&accion=cancelarpaypal&id=<?= $_GET['id'] ?>">
        <input type="hidden" name="rm" value="2">

        <?php $cound = 0; ?>
        <?php foreach ($carrito as $index => $elemento) :
            $producto = $elemento['producto'];
            $cound++; ?>

            <input type="hidden" name="item_number_<?= $cound ?>" value=" <?= $producto->idproducto ?>">
            <input type="hidden" name="item_name_<?= $cound ?>" value="<?= $producto->nombre ?>">
            <input type="hidden" name="amount_<?= $cound ?>" value="<?= $producto->precio ?>">
            <input type="hidden" name="quantity_<?= $cound ?>" value="<?= $elemento['unidades'] ?>">


        <?php endforeach; ?>
        <center>
            <img width="50%" src="<?= base_url ?>assets/img/pagarpaypal.png" alt="Camiseta logo" />
        </center>
        <button>Pagar Ahora</button>

    </form>
    <?php if (isset($_GET['id'])) : ?>
        <form action="<?= base_url ?>index.php?controlador=carrito&accion=cancelarpaypal&id=<?= $_GET['id'] ?>" method="POST">
            <button>Cancelar</button>
        </form>
    <?php endif; ?>
    <br /><br />
</body>

</html>