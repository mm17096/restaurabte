<?php if (isset($edit) && isset($cate) && is_object($cate)) : ?>
    <h1>EDITAR CATEGORIA "<?= $cate->nombre ?>"</h1>
    <?php $url_action = base_url . "index.php?controlador=categoria&accion=edit&id=" . $cate->idcategoria ?>
<?php else : ?>
    <h1>CREAR NUEVA CATEGORIA</h1>
    <?php $url_action = base_url . "index.php?controlador=categoria&accion=guardar" ?>
<?php endif; ?>
<center>
    <div class="form_container">
        <?php
        if (isset($_SESSION['categoria']) && $_SESSION['categoria'] == 'complete') : ?>
            <strong class="alert_green"> REGISTRO COMPLETADO CORRECTAMENTE</strong>
        <?php elseif (isset($_SESSION['categoria']) && $_SESSION['categoria'] == 'failed') : ?>
            <strong class="alert_red">REGISTRO FALLIDO, INTRODUZCA BIEN LOS DATOS</strong>
        <?php endif; ?>
        <?php Utils::deleteSession('categoria') ?>

        <form action="<?= $url_action ?>" method="POST">
            <br />
            <input type="text" name="nombre" placeholder="Nombre de Categoría" pattern="[á-úa-zA-Z- ]+" value="<?= isset($cate) && is_object($cate) ? $cate->nombre : ''; ?>" required><br />

            <?php if (isset($cate) && is_object($cate)) : ?>
                <input type="submit" value="Actualizar"><br /><br />
            <?php elseif (!isset($cate)) : ?>
                <input type="submit" value="Guardar"><br /><br />
            <?php endif; ?>
        </form>
    </div>
</center>
<form action="<?= base_url ?>index.php?controlador=categoria&accion=gestionar" method="POST">
    <button class="boton">Regresar</button>
</form>