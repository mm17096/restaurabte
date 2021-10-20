<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="<?= base_url ?>assets/css/styles3.css">
    <title>Restaurante Quevaquerer</title>

    <script>
        function mostrarContrasena() {
            var tipo = document.getElementById("password");
            var boton = document.getElementById("button");
            if (tipo.type == "password") {
                tipo.type = "text";
                boton.style =
                    "background-image:url(<?= base_url ?>assets/img/ojo_1.png);  background-repeat:no-repeat; font-size: 100%; height:100%; width:25%; background-position:center; "
            } else {
                tipo.type = "password";
                boton.style =
                    "background-image:url(<?= base_url ?>assets/img/ojo1.png);  background-repeat:no-repeat; font-size: 100%; height:100%; width:25%; background-position:center;"
            }
        }
    </script>
</head>

<body>
    <!-- <div id="container">-->
    <!-- CABECERA -->
    <header id="header">
        <div id="logo">
            <img src="<?= base_url ?>assets/img/logo3.png" alt="Camiseta logo" />
            <a href="<?= base_url ?>index.php">
                RESTAURANTE QUEVAQUERER
            </a>
        </div>
    </header>

    <!-- MENU -->
    <?php $categoria = Utils::showCategorias(); ?>
    <nav id="menu">
        <ul>
            <li>
                <a href="<?= base_url ?>index.php?controlador=producto&accion=index">Inicio</a>
            </li>
            <?php while ($cat = $categoria->fetch_object()) : ?>
                <li>
                    <a href="<?= base_url ?>index.php?controlador=categoria&accion=ver&id=<?= $cat->idcategoria ?>"><?= $cat->nombre ?></a>
                </li>
            <?php endwhile; ?>
        </ul>
    </nav>