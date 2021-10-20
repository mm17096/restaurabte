<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <script>
        function verMapa() {
            window.open("mapa.php", "Nuevo", "alwaysRaised=no,toolbar=no,menubar=no,status=no,resizable=no,width=650,height=600,location=no");
            document.getElementById("lat").value = "";
            document.getElementById("lon").value = "";
        }

        function mostrarContrasenia() {
            var tipo = document.getElementById("password_2");
            var boton = document.getElementById("button_2");
            if (tipo.type == "password") {
                tipo.type = "text";
                boton.style =
                    "background-image:url(<?= base_url ?>assets/img/ojo_1.png);  background-repeat:no-repeat; font-size: 100%; height:100%; width:25%; background-position:center;"
            } else {
                tipo.type = "password";
                boton.style =
                    "background-image:url(<?= base_url ?>assets/img/ojo1.png);  background-repeat:no-repeat; font-size: 100%; height:100%; width:25%; background-position:center;"
            }
        }
    </script>
</head>

<body>
    <?php if (isset($edit) && isset($user) && is_object($user)) : ?>
        <h1>EDITAR MI PERFIL</h1>
        <?php $url_action = base_url . "index.php?controlador=usuario&accion=edit&id=" . $user->idcliente ?>
    <?php else : ?>
        <h1>REGISTRARCE COMO USUARIO</h1>
        <?php if (isset($_SESSION['nuevouser'])) : ?>
            <center>
                <strong class="alert_green">PARA HACER USO DE NUESTROS SERVICIOS DEBE REGISTRACE</strong>
            </center>
        <?php endif; ?>
        <?php $url_action = base_url . "index.php?controlador=usuario&accion=save" ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['cambiarubi'])) : ?>
        <a href="<?= base_url ?>index.php?controlador=carrito&accion=hacerpago">Regresar</a>
    <?php elseif (isset($_SESSION['cambiar'])) : ?>
        <a href="<?= base_url ?>index.php?controlador=usuario&accion=ver&id=<?= $_SESSION['identity']->idcliente ?>">Volver</a>
    <?php elseif (!isset($_SESSION['cambiar']) && !isset($_SESSION['cambiarubi'])) : ?>
        <form action="<?= base_url ?>index.php" method="POST">
            <button class="boton">Regresar</button>
        </form>
    <?php endif; ?>
    <center>
        <?php
        if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
            <strong class="alert_green"> REGISTRO COMPLETADO CORRECTAMENTE</strong>
            <?php if (isset($_SESSION['confirmacion']) && $_SESSION['confirmacion'] == 'complete') : ?>
                <br />
                <strong class="alert_green">HEMOS ENVIADO UN MENSAJE A TU CORREO PARA QUE CONFIRMES TU CUENTA</strong>
            <?php elseif (isset($_SESSION['confirmacion']) && $_SESSION['confirmacion'] == 'failed') : ?>
                <br />
                <strong class="alert_red">ERROR AL INTENTAR ENVIAR EL CORREO DE CONFIRMACION</strong>
            <?php endif; ?>
        <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>
            <strong class="alert_red">REGISTRO FALLIDO, INTRODUZCA BIEN LOS DATOS</strong>
        <?php elseif (isset($_SESSION['correo']) && $_SESSION['correo'] == 'failedcorreo') : ?>
            <strong class="alert_red">CORREO E-MAIL INCORRECTO</strong>
        <?php elseif (isset($_SESSION['correo']) && $_SESSION['correo'] == 'correofailed') : ?>
            <strong class="alert_red">CORREO E-MAIL YA ESTA EN USO</strong>
        <?php endif; ?>
        <?php Utils::deleteSession('register'); ?>
        <?php Utils::deleteSession('confirmacion'); ?>
        <?php Utils::deleteSession('correo'); ?>
        <?php Utils::deleteSession('nuevouser'); ?>
        <?php Utils::deleteSession('registro2'); ?>
        <?php Utils::deleteSession('failed'); ?>
        <?php Utils::deleteSession('failedcorreo'); ?>
        <?php Utils::deleteSession('correofailed'); ?>
        <table border="1">
            <div class="form_container">
                <form autocomlete="off" action="<?= $url_action ?>" method="POST" enctype="multipart/form-data">
                    <!-- <?php if (isset($_SESSION['cambiarubi']) || isset($_SESSION['cambiar'])) : ?>

                    <?php else : ?>
                        Codigo para obtener la ubicacion automaticamente
                    <script type="text/javascript">
                        if (navigator.geolocation) {
                            //alert("¡Permitenos saber tu ubicación!");
                            navigator.geolocation.getCurrentPosition(mostrarUbicacion);
                        } else {
                            alert("¡Error! Este navegador no soporta la Geolocalización.");
                        }

                        function mostrarUbicacion(position) {
                            var longitud = position.coords.lat();
                            var latitud = position.coords.lng();
                            var div = document.getElementById("ubicacion");
                            document.getElementById("lat").value = latitud;
                            document.getElementById("lon").value = longitud;
                            div.innerHTML = "Ubicación actual:" + latitud + "&nbsp;" + longitud;
                        }

                        function refrescarUbicacion() {
                            navigator.geolocation.watchPosition(mostrarUbicacion);
                        }
                    </script>

                     Codigo para obtener la ubicacion automaticamente
                     <?php endif; ?>-->

                    <input type="text" name="nombre" placeholder="Nombre de Cliente" pattern="[á-úa-zA-Z- ]+" value="<?= isset($user) && is_object($user) ? $user->nombre : ''; ?>" required><br />

                    <input type="text" name="apellido" placeholder="Apellido de Cliente" pattern="[á-úa-zA-Z- ]+" value="<?= isset($user) && is_object($user) ? $user->apellido : ''; ?>" required>
                    <br />
                    <select name="sexo" required>
                        <option>
                            <?= 'Seleccione Sexo' ?>
                        </option>
                        <option <?= isset($user) && is_object($user) && $user->sexo == "Hombre" ? 'selected' : ''; ?>>
                            <?= 'Hombre' ?>
                        </option>
                        <option <?= isset($user) && is_object($user) && $user->sexo == "Mujer" ? 'selected' : ''; ?>>
                            <?= 'Mujer' ?>
                        </option>
                    </select>
                    <br />
                    <input type="text" name="telefono" placeholder="Teléfono de Cliente" maxlength="9" value="<?= isset($user) && is_object($user) ? $user->telefono : ''; ?>" required><br />

                    <input type="text" name="dui" placeholder="DUI de Cliente" maxlength="10" value="<?= isset($user) && is_object($user) ? $user->dui : ''; ?>" required><br />

                    <input type="email" name="correoN" placeholder="Correo E-Mail" value="<?= isset($user) && is_object($user) ? $user->correonormal : ''; ?>" required><br />

                    <input type="password" name="password" minlength="6" maxlength="15" id="password_2" placeholder="Contraseña de Usuario" value="<?= isset($user) && is_object($user) ? Utils::desencriptacion($user->contrasenia) : ''; ?>" required>
                    <button class="btn btn-primary" type="button" id="button_2" onclick="mostrarContrasenia()" style="background-image:url(<?= base_url ?>assets/img/ojo1.png);  background-repeat:no-repeat; font-size: 100%; height:100%; width:25%; background-position:center;"></button>

                    <?php if (isset($_SESSION['cambiarubi'])) : ?>
                        <button class="boton2" onClick="verMapa()">Obtener Ubicación</button>
                        <input type="text" name="longitud" id="lon" placeholder="longitud de Ubicación" required><br />

                        <input type="text" name="latitud" id="lat" placeholder="Latitud de Ubicación" required><br />

                    <?php else : ?>
                        <button class="boton2" onClick="verMapa()">Obtener Ubicación</button>
                        <input type="text" name="longitud" id="lon" placeholder="longitud de Ubicación" value="<?= isset($user) && is_object($user) ? $user->longitud : ''; ?>" required><br />

                        <input type="text" name="latitud" id="lat" placeholder="Latitud de Ubicación" value="<?= isset($user) && is_object($user) ? $user->latitud : ''; ?>" required><br />

                    <?php endif; ?>
                    <?php if (isset($user) && is_object($user) && !empty($user->imagen)) : ?>
                        <img height="60px" src="data:image/jpg;base64,<?php echo base64_encode($user->imagen) ?>" /><br /><br />
                        <input type="file" name="imagen"><br /><br />
                    <?php else : ?>
                        <input class="file" type="file" name="imagen"><br />
                    <?php endif; ?>


                    <?php if (isset($_SESSION['cambiarubi'])) : ?>
                        <input type="submit" value="Actualizar Ubicacion"><br /><br />
                    <?php elseif (isset($user) && is_object($user)) : ?>
                        <input type="submit" value="Actualizar"><br /><br />
                    <?php elseif (!isset($cate)) : ?>
                        <input type="submit" value="Regsitrarse"><br /><br />
                    <?php endif; ?>
                    <br /><br /> <br /><br /> <br /><br /><br /><br />
                </form>
        </table>
    </center>
    </div>
</body>

</html>