<h1>GESTIONAR DIAS LABORADOS</h1>
<a href="<?= base_url ?>index.php?controlador=producto&accion=index" class="button button-small">Regresar</a>
<a href=" <?= base_url ?>index.php?controlador=empresa&accion=nuevodia" class="button button-small">Agregar día laborar</a>
<center>
    <?php if (isset($_SESSION['nolaboral'])) : ?>
        <strong class="alert_green">NO HAY DIAS LABORADOS AUN</strong>
    <?php endif; ?>
    <?php if (isset($_SESSION['nuevodia'])) : ?>
        <strong class="alert_green">HA SIDO CREADO EL NUEVO DIA</strong>
    <?php endif; ?>
    <?php if (isset($_SESSION['existedia'])) : ?>
        <strong class="alert_red">ACTUALMENTE HAY UN DIA LABORAL</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('nolaboral') ?>
    <?php Utils::deleteSession('nuevodia') ?>
    <?php Utils::deleteSession('existedia') ?>
</center>
<br />
<table>
    <tr>
        <th>Estado</th>
        <th>Fecha</th>
        <th>Pedidos Atendidos</th>
        <th>Saldo del día</th>
        <th>Acciones</th>
    </tr>
    <?php while ($empresa = $empresas->fetch_object()) : ?>
        <tr>
            <td><?= $empresa->estado; ?></td>
            <td><?= $empresa->fecha; ?>
            <td><?= $empresa->pedidos; ?></td>
            <td><?= $empresa->saldo; ?></td>
            <td>
                <center>
                    <?php if ($empresa->estado == 'Activo' || $empresa->estado == 'Cerrado') : ?>
                        <?php if ($empresa->estado == 'Activo') : ?>
                            <a href="<?= base_url ?>index.php?controlador=empresa&accion=cerrar&id=<?= $empresa->id_laboral ?>" class="button button-small">Cerrar</a>
                        <?php else : ?>
                            <a href=" <?= base_url ?>index.php?controlador=empresa&accion=activar&id=<?= $empresa->id_laboral ?>" class="button button-small">Activar</a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <a href="<?= base_url ?>index.php?controlador=empresa&accion=ver&id=<?= $empresa->id_laboral; ?>" class="button button-small">Ver</a>
                </center>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<br /><br />