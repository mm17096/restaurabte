<h1>GESTIONAR CLIENTES</h1>
<a href="<?= base_url ?>index.php?controlador=producto&accion=index" class="button button-small">
    Regresar
</a>
<center>
    <?php if (isset($_SESSION['nouser'])) : ?>
        <strong class="alert_green">NO HAY USUARIOS AUN</strong>
    <?php endif; ?>
    <?php Utils::deleteSession('nouser') ?>
</center>
<br />
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Confirmación</th>
        <th>Correo</th>
        <th>Acciones</th>
    </tr>
    <?php while ($user = $users->fetch_object()) : ?>
        <tr>
            <td><?= $user->idcliente; ?></td>
            <td><?= $user->nombre; ?> <?= $user->apellido; ?></td>
            <td><?= $user->telefono; ?></td>
            <td><?= $user->confirmacion; ?></td>
            <td><?= $user->correonormal; ?></td>
            <td>
                <center>
                    <?php if ($user->confirmacion == 'NO') : ?>
                        <a href="<?= base_url ?>index.php?controlador=usuario&accion=eliminar&id=<?= $user->idcliente; ?>&tipo=gestion" class="button">Eliminar</a>
                    <?php else : ?>
                        <a href="<?= base_url ?>index.php?controlador=pedido&accion=pedidoscliente&id=<?= $user->idcliente; ?>&tipo=gestion" class="button">Ver Pedidos</a>
                    <?php endif; ?>

                </center>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<br /><br />