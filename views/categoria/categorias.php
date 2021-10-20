 <h1>GESTIONAR CATEGORIAS</h1>

 <a href="<?= base_url ?>index.php?controlador=categoria&accion=crear" class="button button-small">
     Crear categoría
 </a>
 <a href="<?= base_url ?>index.php?controlador=producto&accion=index" class="button button-small">
     Regresar
 </a>
 <center>
     <?php
        if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') : ?>
         <strong class="alert_green"> REGISTRO ELIMINADO CORRECTAMENTE</strong>
     <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] == 'failed') : ?>
         <strong class="alert_red">PROCESO FALLIDO, EL REGISTRO ESTA RELACIONADO CON OTRO REGISTRO</strong>
     <?php endif; ?>
     <?php Utils::deleteSession('delete') ?>
 </center>
 <center>
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
         <th>Operaciones</th>
     </tr>
     <?php while ($cat = $categorias->fetch_object()) : ?>
         <tr>
             <td><?= $cat->idcategoria; ?></td>
             <td><?= $cat->nombre; ?></td>
             <td>
                 <center>
                     <a href="<?= base_url ?>index.php?controlador=categoria&accion=editar&id=<?= $cat->idcategoria ?>" class="button button-small">Editar</a>
                     <a href="<?= base_url ?>index.php?controlador=categoria&accion=eliminar&id=<?= $cat->idcategoria ?>" class="button button-small button-red">Eiminar</a>
                 </center>
             </td>
         </tr>
     <?php endwhile; ?>
 </table>
 <br /><br />