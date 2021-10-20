<h1>GESTIONAR PEDIDOS</h1>
<a href="<?= base_url ?>index.php?controlador=producto&accion=index" class="button button-small">
    Regresar
</a>
<?php if (!isset($_SESSION['entregados'])) : ?>
    <a href="<?= base_url ?>index.php?controlador=pedido&accion=gestionar&tipo=Entregado" class="button button-small">
        Ver Ordenes Entregadas
    </a>
<?php else : ?>
    <a href="<?= base_url ?>index.php?controlador=pedido&accion=gestionar&tipo=Pendiente" class="button button-small">
        Ver Ordenes Pendietes
    </a>
<?php endif; ?>
<center>
    <?php if (isset($_SESSION['noordenes'])) : ?>
        <strong class="alert_green">NO HAY ORDENES AUN</strong>
    <?php elseif (isset($_SESSION['nopendientes'])) : ?>
        <strongclass="alert_green">NO HAY ORDENES PENDIENTES</strong>
        <?php elseif (isset($_SESSION['noentregados'])) : ?>
            <strong class="alert_green">NO HAY ORDENES ENTREGADAS</strong>
        <?php elseif (isset($_SESSION['cambio'])) : ?>
            <strong class="alert_green">SE HA ENTREGADO EL PEDIDO</strong>
         <?php elseif (isset( $_SESSION['negacion'])) : ?>
            <strong class="alert_green">EL PEDIDO HA SIDO NEGADO</strong>
        <?php endif; ?>
        <?php Utils::deleteSession('nopendientes') ?>
        <?php Utils::deleteSession('noentregados') ?>
        <?php Utils::deleteSession('entregados') ?>
        <?php Utils::deleteSession('noordenes') ?>
        <?php Utils::deleteSession('cambio') ?>
        <?php Utils::deleteSession('negacion') ?>
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
                    <?php if ($orden->estado != 'Entregado') : ?>
                        <a href="<?= base_url ?>index.php?controlador=pedido&accion=editarestado&id=<?= $orden->idorden; ?>" class="button button-gestion">Entregado</a>
                    <?php endif; ?>
                    <a href="<?= base_url ?>index.php?controlador=pedido&accion=ver&id=<?= $orden->idorden; ?>" class="button">Ver</a>
                </center>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<br /><br />