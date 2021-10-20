<?php if (isset($categoria)) : ?>


   <h1>
      <?= $categoria->nombre ?>
   </h1>


   <?php if ($productos->num_rows == 0) : ?>
      <p>No hay productos para mostrar</p>
   <?php else : ?>

      <?php while ($pro = $productos->fetch_object()) : ?>

         <div class="product">
            <a href="<?= base_url ?>index.php?controlador=producto&accion=ver&id=<?= $pro->idproducto ?>">
               <img width="70%" src="data:image/jpg;base64,<?php echo base64_encode($pro->imagen) ?>" />
               <h2><?= $pro->nombre; ?></h2>
            </a>
            <?php if ($pro->cantidadorden == 1) : ?>
               <p>El producto esta en <?= $pro->cantidadorden; ?> pedido</p>
            <?php else : ?>
               <p>El producto esta en <?= $pro->cantidadorden; ?> pedidos</p>
            <?php endif; ?>

            <?php if ($pro->cantidadpro != null) : ?>
               <?php if ($pro->cantidadpro == 1) : ?>
                  <p>La cantidad en espera es de <?= $pro->cantidadpro; ?> unidad</p>
               <?php else : ?>
                  <p>La cantidad en espera es de <?= $pro->cantidadpro; ?> unidades</p>
               <?php endif; ?>
            <?php else : ?>
               <p>La cantidad en espera es de 0 unidades</p>
            <?php endif; ?>
            <p>Precio: $<?= $pro->precio; ?> C/u</p>
            <center>
               <a href=" <?= base_url ?>index.php?controlador=carrito&accion=add&id=<?= $pro->idproducto ?>" class="button button-small">Agregar a Carrito</a>
            </center>
         </div>
      <?php endwhile; ?>
   <?php endif; ?>
<?php else : ?>
   <h1>No existe la categoría</h1>
<?php endif; ?>