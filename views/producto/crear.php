
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php if (isset($edit) && isset($pro) && is_object($pro)) : ?>
    <h1>EDITAR PRODUCTO "<?= $pro->nombre ?>"</h1>
    <?php $url_action = base_url . "index.php?controlador=producto&accion=edit&id=" . $pro->idproducto ?>
<?php else : ?>
    <h1>CREAR NUEVO PRODUCTO</h1>
    <?php $url_action = base_url . "index.php?controlador=producto&accion=save" ?>
<?php endif; ?>
<center>
    <table border="1">
        <div class="form_container">
            <?php
            if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete') : ?>
                <strong class="alert_green"> REGISTRO COMPLETADO CORRECTAMENTE</strong>
            <?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] == 'failed') : ?>
                <strong class="alert_red">REGISTRO FALLIDO, INTRODUZCA BIEN LOS DATOS</strong>
            <?php endif; ?>
            <?php Utils::deleteSession('producto') ?>
            <form>

            </form>
            <form action="<?= $url_action ?>" method="POST" enctype="multipart/form-data">

                <input type="text" name="nombre" placeholder="Nombre de Producto" pattern="[á-úa-zA-Z- ]+" value="<?= isset($pro) && is_object($pro) ? $pro->nombre : ''; ?>" required><br />

                <textarea name="descripcion" pattern="[á-úa-zA-Z- ]+" placeholder="Descripción de Producto"><?= isset($pro) && is_object($pro) ? $pro->descripcion : ''; ?></textarea><br />

                <input type="doble" name="precio" placeholder="Precio de Producto" value="<?= isset($pro) && is_object($pro) ? $pro->precio : ''; ?>" required><br />

                <?php $categorias = Utils::showCategorias(); ?>
                <select name="categoria" required>
                    <option value="<?= $cat->idcategoria ?>">
                        <?= 'Seleccione Categoría' ?>
                    </option>
                    <?php while ($cat = $categorias->fetch_object()) : ?>
                        <option value="<?= $cat->idcategoria ?>" <?= isset($pro) && is_object($pro) && $cat->idcategoria == $pro->categoria ? 'selected' : ''; ?>>
                            <?= $cat->nombre ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <br />
                <?php if (isset($pro) && is_object($pro) && !empty($pro->imagen)) : ?>
                    <img height="60px" src="data:image/jpg;base64,<?php echo base64_encode($pro->imagen) ?>" /><br /><br />
                <?php endif; ?>
                <input class="file" type="file" name="imagen"><br /><br />

                <select name="disponible" required>
                    <option>
                        <?= 'Seleccione Estado' ?>
                    </option>

                    <option <?= isset($pro) && is_object($pro) && $pro->disponible == "SI" ? 'selected' : ''; ?>>
                        <?= 'SI' ?>
                    </option>
                    <option <?= isset($pro) && is_object($pro) && $pro->disponible == "NO" ? 'selected' : ''; ?>>
                        <?= 'NO' ?>
                    </option>
                </select>

                <?php if (isset($pro) && is_object($pro)) : ?>
                    <input type="submit" value="Actualizar"><br /><br />
                <?php elseif (!isset($pro)) : ?>
                    <input  type="submit" value="Guardar"><br /><br />
                <?php endif; ?>
                <br /><br /> <br /><br /> <br /><br /><br /><br />
            </form>

    </table>
</center>
<form action="<?= base_url ?>index.php?controlador=producto&accion=gestionar" method="POST">
    <button class="boton">Regresar</button>
</form>
</div>
</body>
</html>