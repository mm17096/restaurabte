<?php if (isset($user)) : ?>

    <header id="header">
        <h1>PERFIL DE CLIENTE</h1>
        <?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
            <strong class="alert_green">
                <h6>REGISTRO MODIFICADO CORRECTAMENTE</h6>
            </strong>
        <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>
            <strong class="alert_red">
                <h6>MODIFICACION FALLIDA</h6>
            </strong>
        <?php endif; ?>
        <?php Utils::deleteSession('register') ?>

    </header>

    <div class="product">
        <?php if ($user->imagen != null) : ?>
            <img height="200px" width="135px" src="data:image/jpg;base64,<?php echo base64_encode($user->imagen) ?>" />
        <?php else : ?>
            <img height="200px" width="175px" src="<?= base_url ?>assets/img/usuario.png" alt="Camiseta logo" />
        <?php endif; ?>
    </div>
    <div id="detail-product">
        <p>
            <h4>Nombre:</h4> <?= $user->nombre ?> <?= $user->apellido ?>
        </p>
        <p>
            <h4>Teléfono:</h4> <?= $user->telefono ?>
        </p>
        <p>
            <h4>DUI:</h4><?= $user->dui ?>
        </p>
        <p>
            <h4>Correo E-Mail:</h4> <?= $user->correonormal ?>
        </p>
        <p>
            <h4>Latitud de Ubicación:</h4> <?= $user->latitud ?>
        </p>
        <p>
            <h4>Longitud de Ubicación:</h4><?= $user->longitud ?>
        </p>
    </div>
    <a href=" <?= base_url ?>index.php?controlador=usuario&accion=editar&id=<?= $user->idcliente ?>&cambiar=todo" class="button button-small">Modificar datos</a>
    <a href=" <?= base_url ?>index.php?controlador=producto&accion=index" class="button button-small">Salir</a>
<?php else : ?>
    <h1>No existe el Cliente</h1>
<?php endif; ?>