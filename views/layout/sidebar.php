    <!-- BARRA LATERAL -->
    <div>
        <aside id="lateral">
            <div id="login" class="block_aside">
                <div id="otro">
                    <?php if (!isset($_SESSION['identity'])) : ?>
                    <form action="<?= base_url ?>index.php?controlador=usuario&accion=login" method="POST">
                        <h3>Inicio de Sesión</h3>
                        <lavel for="email">Usuario</lavel>
                        <input type="email" name="usuario" placeholder="Correo de Cliente" required>
                        <lavel for="password">Contraseña</lavel>
                        <input type="password" id="password" name="password" placeholder="Contraseña" required>
                        <button type="button" id="button" onclick="mostrarContrasena()"
                            style="background-image:url(<?= base_url ?>assets/img/ojo1.png);   background-repeat:no-repeat; font-size: 100%; height:100%; width:25%; background-position:center;"></button>
                        <input type="submit" value="Ingresar">
                    </form>
                    
                    <form action="<?= base_url ?>index.php?controlador=usuario&accion=registro" method="POST">
                        <button>Registrarse</button>
                    </form>
                    <a href="<?= base_url ?>index.php?controlador=empresa&accion=informacion">¿Información de la
                        pagina?</a>
                    <br />
                    <?php if (isset($_SESSION['error_login']) && $_SESSION['error_login'] == true) : ?>
                    <strong class="alert_red">
                        Introduzca bien los datos o regístrese y confirme su cuenta
                        con el correo electrónico; respete Mayúsculas y Minúsculas.
                    </strong>
                    <br />
                    <a href="<?= base_url ?>index.php?controlador=usuario&accion=contrasenia_">¿Has olvidado tu
                        contraseña?</a>
                    <?php endif; ?>

                    <?php endif; ?>

                    <?php if (isset($_SESSION['identity']) && is_object($_SESSION['identity'])) : ?>
                    <?php if ($_SESSION['identity']->sexo == 'Hombre') : ?>
                    <h3>Bienvenido <?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellido ?></h3>
                    <?php else : ?>
                    <h3>Bienvenida <?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellido ?></h3>
                    <?php endif; ?>


                    <ul>
                        <?php if ($_SESSION['identity']->rol == 'admin') : ?>
                        <li><a href="<?= base_url ?>index.php?controlador=categoria&accion=gestionar">Gestionar
                                Categorias</a></li><br />
                        <li><a href="<?= base_url ?>index.php?controlador=producto&accion=gestionar">Gestionar
                                Productos</a></li><br />
                        <li><a href="<?= base_url ?>index.php?controlador=pedido&accion=gestionar&tipo=Pendiente">Gestionar
                                Pedidos</a></li><br />
                        <li><a href="<?= base_url ?>index.php?controlador=usuario&accion=gestionar">Clientes</a></li>
                        <br />
                        <li><a href="<?= base_url ?>index.php?controlador=empresa&accion=gestionar">Empresa</a></li>
                        <?php endif; ?>
                    </ul>

                    <li><a href="<?= base_url ?>index.php?controlador=carrito&accion=index">Ver Pedido</a></li><br />
                    <li><a
                            href="<?= base_url ?>index.php?controlador=pedido&accion=pedidoscliente&id=<?= $_SESSION['identity']->idcliente ?>">Mis
                            Pedidos</a></li><br />
                    <li><a
                            href="<?= base_url ?>index.php?controlador=usuario&accion=ver&id=<?= $_SESSION['identity']->idcliente ?>">Mi
                            Perfil</a></li><br />
                    <li><a href="<?= base_url ?>index.php?controlador=usuario&accion=logout">Cerrar Sesión</a></li>
                    <br />

                    <?php if ($_SESSION['identity']->rol == 'usuario') : ?>
                    <h3> Carrito de compra</h3>
                    <ul>
                        <?php $stats = Utils::statscarrito() ?>
                        <li><a>Productos Individuales(<?= $stats['productos'] ?>)</a></li><br />
                        <li><a>Unidades Totales(<?= $stats['unidades'] ?>)</a></li><br />
                        <li><a>Total :$<?= $stats['total'] ?></a></li><br />
                    </ul>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </aside>
    </div> <!-- CONTENIDO CENTRAL -->
    <div id="central">