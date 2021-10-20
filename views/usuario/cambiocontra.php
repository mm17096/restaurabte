<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de Contrasenia</title>
    <script>
        function mostrarContrasenia() {
            var tipo1 = document.getElementById("password_1");
            var tipo2 = document.getElementById("password_2");
            var boton = document.getElementById("button_2");
            if (tipo1.type == "password" && tipo2.type == "password") {
                tipo1.type = "text";
                tipo2.type = "text";
                boton.style =
                    "background-image:url(<?= base_url ?>assets/img/ojo_1.png);  background-repeat:no-repeat; font-size: 100%; height:100%; width:25%; background-position:center;"
            } else {
                tipo1.type = "password";
                tipo2.type = "password";
                boton.style =
                    "background-image:url(<?= base_url ?>assets/img/ojo1.png);  background-repeat:no-repeat; font-size: 100%; height:100%; width:25%; background-position:center;"
            }
        }
    </script>
</head>

<body>
    <center>
        <div class="form_container">
            <?php if (isset($_SESSION['contracomplete'])) : ?>
                <center>
                    <h3>Ha cambiado su contraseña</h3>
                    <h3>Ahora puedes usar su nueva contraseña</h3>
                    <img width="70%" src="<?= base_url ?>assets/img/procesocompleto.png" alt="Camiseta logo" />
                    <a href=" <?= base_url ?>index.php?controlador=producto&accion=index" class="button button-small">Aceptar</a>
                </center>
            <?php else : ?>
                <?php if (isset($_SESSION['opcioncontra'])) : ?>
                    <?php if ($_SESSION['opcioncontra'] == 'cambiar') : ?>
                        <?php if (isset($_SESSION['usuario']) && is_object($_SESSION['usuario'])) : ?>
                            <h1>Usuario: <?= $_SESSION['usuario']->nombre ?> <?= $_SESSION['usuario']->apellido ?></h1>
                            <?php if (isset($_SESSION['error_contra'])) : ?>
                                <strong class="alert_red">VERIFIQUE CORRECTAMENTE LAS CONTRASENIAS</strong>
                                <br />
                            <?php endif; ?>
                            <form action="<?= base_url ?>index.php?controlador=usuario&accion=cambiocontra&idcliente=<?= $_SESSION['usuario']->idcliente ?>" method="POST">
                                <input type="password" minlength="6" maxlength="15" name="password_1" id="password_1" placeholder="Nueva Contraseña" required>
                                <input type="password" minlength="6" maxlength="15" name="password_2" id="password_2" placeholder="Confirmar contraseña" required>
                                <button class="btn btn-primary" type="button" id="button_2" onclick="mostrarContrasenia()" style="background-image:url(<?= base_url ?>assets/img/ojo1.png);  background-repeat:no-repeat; font-size: 100%; height:100%; width:25%; background-position:center;"></button>

                                <input type="submit" value="Continuar Proceso">
                            </form>
                            <br />
                            <a href=" <?= base_url ?>index.php?controlador=producto&accion=index" class="button button-small">Salir</a>
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
                            <a href=" <?= base_url ?>index.php?controlador=producto&accion=index" class="button button-small">Salir</a>
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
            <?php endif; ?>
        </div>
    </center>
</body>

</html>