<center>
    <div class="form_container">
        <?php if (isset($_SESSION['opcioncontra'])) : ?>
            <?php if ($_SESSION['opcioncontra'] == 'cambiar') : ?>

                <?php if (isset($_SESSION['usuario']) && is_object($_SESSION['usuario'])) : ?>
                    <strong class="alert_green">HEMOS ENVIADO UN CODIGO A TU CORREO INGRESALO Y CONTINUA</strong>
                    <br />
                    <form action="<?= base_url ?>index.php?controlador=usuario&accion=procesocambio2&opcion=cambiar" method="POST">
                        <input type="email" name="correo" placeholder="Correo E-Mail" value="<?= $_SESSION['usuario']->correonormal ?>" required><br />
                        <input type="text" name="dui" placeholder="DUI de usuario" value="<?= $_SESSION['usuario']->dui ?>" required><br />
                        <input type="text" name="codigo" placeholder="Codiogo de Seguridad" required><br />
                        <input type="submit" value="Continuar Proceso">
                    </form>
                    <br />
                    <a href=" <?= base_url ?>index.php?controlador=usuario&accion=contrasenia_" class="button button-small">Salir</a>
                <?php else : ?>
                    <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario'] == 'no') : ?>
                        <strong class="alert_red">LOS DATOS NO COINCIDEN CON NINGUN REGISTRO</strong>
                        <br />
                    <?php endif; ?>
                    <form action="<?= base_url ?>index.php?controlador=usuario&accion=procesocambio&opcion=cambiar" method="POST">
                        <input type="email" name="correo" placeholder="Correo E-Mail" required><br />
                        <input type="text" name="dui" placeholder="DUI de usuario" required><br />
                        <input type="submit" value="Continuar Proceso">
                    </form>
                    <br />
                    <a href=" <?= base_url ?>index.php?controlador=usuario&accion=contrasenia_" class="button button-small">Salir</a>
                <?php endif; ?>

            <?php else : ?>

                <?php if (isset($_SESSION['usuario']) && is_object($_SESSION['usuario'])) : ?>
                    <?php if (isset($_SESSION['contraenviada']) && $_SESSION['contraenviada']) : ?>
                        <center>
                            <strong class="alert_green">HEMOS ENVIADO LA CONTRASENIA A SU CORREO</strong>
                            <br />
                            <h3>Intenta volver a iniciar sesion con tu contrasenia</h3>
                            <h3>Si no te funciona puedes volver a intentar cambiar tu contrasenia</h3>
                            <img width="70%" src="<?= base_url ?>assets/img/procesocompleto.png" alt="Camiseta logo" />
                            <a href=" <?= base_url ?>index.php?controlador=producto&accion=index" class="button button-small">Aceptar</a>
                        </center>
                    <?php else : ?>
                        <strong class="alert_red">ALGO SALIO MAL AL ENVIARTE LA CONTRASENIA AL CORREO</strong>
                        <br />
                        <center>
                            <a href=" <?= base_url ?>index.php?controlador=usuario&accion=contrasenia_" class="button button-small">Intentar de nuevo</a>
                        </center>
                    <?php endif; ?>
                <?php else : ?>
                    <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario'] == 'no') : ?>
                        <strong class="alert_red">LOS DATOS NO COINCIDEN CON NINGUN REGISTRO</strong>
                        <br />
                    <?php endif; ?>
                    <form action="<?= base_url ?>index.php?controlador=usuario&accion=procesocambio&opcion=recuperar" method="POST">
                        <input type="email" name="correo" placeholder="Correo E-Mail" required><br />
                        <input type="text" name="dui" placeholder="DUI de usuario" required><br />
                        <input type="submit" value="Continuar Proceso">
                    </form>
                    <br />
                    <a href=" <?= base_url ?>index.php?controlador=usuario&accion=contrasenia_" class="button button-small">Salir</a>
                <?php endif; ?>

            <?php endif; ?>
        <?php else : ?>
            <h1>¿Que accion desea realizar?</h1>
            <center>
                <a href=" <?= base_url ?>index.php?controlador=usuario&accion=opcioncambio&opcion=cambiar" class="button button-small">Cambiar contraseña</a>
                <a href=" <?= base_url ?>index.php?controlador=usuario&accion=opcioncambio&opcion=recuperar" class="button button-small">Recuperar contraseña</a>
                <a href=" <?= base_url ?>index.php?controlador=producto&accion=index" class="button button-small">Salir</a>
            </center>
        <?php endif; ?>

    </div>
</center>