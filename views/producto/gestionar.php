    <h1>GESTIONAR PRODUCTOS</h1>

    <a href="<?= base_url ?>index.php?controlador=producto&accion=crear" class="button button-small">
        Crear Producto
    </a>
    <a href="<?= base_url ?>index.php?controlador=producto&accion=index" class="button button-small">
        Regresar
    </a>
    <center>
        <?php
        if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') : ?>
            <strong class="alert_green"> REGISTRO ELIMINADO CORRECTAMENTE</strong>
        <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed') : ?>
            <strong class="alert_red">PROCESO FALLIDO, EL REGISTRO NO SE ELIMINO</strong>
        <?php endif; ?>
        <?php Utils::deleteSession('delete') ?>

        <?php
        if (isset($_SESSION['update']) && $_SESSION['update'] == 'complete') : ?>
            <strong class="alert_green"> REGISTRO MODIFICADO CORRECTAMENTE</strong>
        <?php elseif (isset($_SESSION['update']) && $_SESSION['update'] == 'failed') : ?>
            <strong class="alert_red">PROCESO FALLIDO, EL REGISTRO NO SE HA MODIFICADO</strong>
        <?php endif; ?>
        <?php Utils::deleteSession('update') ?>
    </center>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
        <?php while ($pro = $productos->fetch_object()) : ?>
            <tr>
                <td><?= $pro->idproducto; ?></td>
                <td><?= $pro->nombre; ?></td>
                <td><img height="60px" src="data:image/jpg;base64,<?php echo base64_encode($pro->imagen) ?>" /></td>
                <td><?= $pro->precio; ?></td>
                <td>
                    <center>
                        <a href="<?= base_url ?>index.php?controlador=producto&accion=editar&id=<?= $pro->idproducto ?>" class="button button-gestion">Editar</a>
                        <a href="<?= base_url ?>index.php?controlador=producto&accion=eliminar&id=<?= $pro->idproducto ?>" class="button button-gestion button-red">Eiminar</a>
                    </center>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <br />