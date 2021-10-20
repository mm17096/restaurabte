<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <h1>INFORMACION DEL DIA LABORADO Y PEDIDOS</h1>
    <a href=" <?= base_url ?>index.php?controlador=empresa&accion=gestionar" class="button button-small">Salir</a>
    <div class="product">
        <img height="150px" width="150px" src="<?= base_url ?>assets/img/logo3.png" alt="Camiseta logo" />
    </div>
    <p>
        <h4>Fecha :</h4> <?= $empresa->fecha ?>
    </p>
    <p>
        <h4>Pedidos Atendidos :</h4> <?= $empresa->pedidos ?>
    </p>
    <p>
        <h4>Saldo del día $:</h4> <?= $empresa->saldo ?>
    </p>
    <br /><br /><br /><br /><br /><br />
    <h3>Total: $<?= $empresa->saldo ?></h3>
    <br />
    <table>
        <tr>
            <th>ID</th>
            <th>ID Cliente</th>
            <th>Fecha y Hora</th>
            <th>Costo</th>
            <th>Tipo de pago</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php while ($orden = $ordenes->fetch_object()) : ?>
            <tr>
                <td><?= $orden->idorden; ?></td>
                <td><?= $orden->cliente; ?></td>
                <td><?= $orden->fecha; ?> <?= $orden->hora; ?></td>
                <td><?= $orden->costototal; ?></td>
                <td><?= $orden->tipodepago; ?></td>
                <td><?= $orden->estado; ?></td>
                <td>
                    <center>
                        <a href="<?= base_url ?>index.php?controlador=pedido&accion=ver&id=<?= $orden->idorden;  ?>&idem=<?= $empresa->id_laboral;  ?>" class="button">Ver</a>
                    </center>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br /><br />
</body>

</html>