<h1>PEDIDOS DE CLIENTE</h1>
<?php if (isset($_SESSION['gestion'])) : ?>
    <a href="<?= base_url ?>index.php?controlador=usuario&accion=gestionar" class="button button-small">
        Volver
    </a>
<?php else : ?>
    <a href="<?= base_url ?>index.php?controlador=producto&accion=index" class="button button-small">
        Regresar
    </a>
<?php endif; ?>
<center>
    <?php if (isset($_SESSION['sinpedidos'])) : ?>
        <strong class="alert_green">NO HAY PEDIDOS AUN</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('sinpedidos') ?>
</center>
<br />
<table>
    <tr>
        <th>ID</th>
        <th>ID Cliente</th>
        <th>Fecha y Hora</th>
        <th>Costo</th>
        <th>Tipo de pago</th>
        <th>Estado</th>
        <?php if (isset($_SESSION['gestion']) || isset($_SESSION['admin'])) : ?>
            <th>Acciones</th>
        <?php endif; ?>
    </tr>
    <?php while ($orden = $ordenes->fetch_object()) : ?>
        <tr>
            <td><?= $orden->idorden; ?></td>
            <td><?= $orden->cliente; ?></td>
            <td><?= $orden->fecha; ?> <?= $orden->hora; ?></td>
            <td><?= $orden->costototal; ?></td>
            <td><?= $orden->tipodepago; ?></td>
            <td><?= $orden->estado; ?></td>

            <?php if (isset($_SESSION['gestion']) || isset($_SESSION['admin'])) : ?>
                <td>
                    <center>
                        <a href="<?= base_url ?>index.php?controlador=pedido&accion=ver&id=<?= $orden->idorden;  ?>&iduser=<?= $orden->cliente; ?>" class="button">Ver</a>
                    </center>
                </td>
            <?php endif; ?>
        </tr>
    <?php endwhile; ?>
</table>
<br /><br />