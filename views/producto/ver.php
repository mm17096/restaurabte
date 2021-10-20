<?php if (isset($product)) : ?>
    <h1>
        <?= $product->nombre ?>
    </h1>
    <div class="product">
        <img width="70%" src="data:image/jpg;base64,<?php echo base64_encode($product->imagen) ?>" />
    </div>
    <div id="detail-product">
        <h2><?= $product->nombre; ?></h2>
        <p class="description"><?= $product->descripcion; ?></p>
        <p class="descripcion">Precio: $ <?= $product->precio; ?> C/u</p>
        <a href=" <?= base_url ?>index.php?controlador=carrito&accion=add&id=<?= $product->idproducto ?>">Agregar a Carrito</a>

    </div>
<?php else : ?>
    <h1>No existe el Producto</h1>
<?php endif; ?>