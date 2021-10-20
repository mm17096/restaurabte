<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Tienda de Camisetas</title>
</head>

<body>
    <!-- <div id="container">-->
    <!-- CABECERA -->
    <header id="header">
        <div id="logo">
            <img src="assets/img/camiseta.png" alt="Camiseta logo" />
            <a href="index.php">
                Tienda de Camisetas
            </a>
        </div>
    </header>

    <!-- MENU -->
    <nav id="menu">
        <ul>
            <li>
                <a href="#">Inicio</a>
            </li>
            <li>
                <a href="#">Productos</a>
            </li>
            <li>
                <a href="#">Pedidos</a>
            </li>
            <li>
                <a href="#">Categorias</a>
            </li>
            <li>
                <a href="#">Ventas</a>
            </li>
            <li>
                <a href="#">Compras</a>
            </li>
        </ul>
    </nav>

    <!-- CONTENIDO CENTRAL -->
    <div id="central">
        <h1>Productos destacados</h1>
        <div class="product">
            <img src="assets/img/camiseta.png" />
            <h2>Camiseta Azul Ancha</h2>
            <p>30 euros</p>
            <a href="#" class="button">Comprar</a>
        </div>

        <div class="product">
            <img src="assets/img/camiseta.png" />
            <h2>Camiseta Azul Ancha</h2>
            <p>30 euros</p>
            <a href="#" class="button">Comprar</a>
        </div>

        <div class="product">
            <img src="assets/img/camiseta.png" />
            <h2>Camiseta Azul Ancha</h2>
            <p>30 euros</p>
            <a href="#" class="button">Comprar</a>
        </div>
    </div>

    <!-- BARRA LATERAL -->
    <div id="content">
        <aside id="lateral">

            <div id="login" class="block_aside">
                <form action="#" method="post">
                    <h3>Entrar a la Web</h3>
                    <lavel for="email">E-Mail</lavel>
                    <input type="email" name="email">
                    <lavel for="password">Contraseña</lavel>
                    <input type="password" name="password">
                    <input type="submit" value="Enviar">
                </form>
                <br />
                <ul>
                    <li><a href="#">Mis Pedidos</a></li><br />
                    <li><a href="#">Gestionar Pedidos</a></li><br />
                    <li><a href="#">Gestionar Categorias</a></li>
                </ul>
            </div>

        </aside>

    </div>

    <!-- PIE DE PAGINA -->
    <footer id="footer">
        <p>Desarrollado por Kevin Mejia WEB &copy; <?=date('Y')?></p>
    </footer>
    <!--</div>-->
</body>

</html>