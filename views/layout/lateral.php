     <!-- BARRA LATERAL -->

     <div>
         <aside id="lateral">

             <div id="login" class="block_aside">
                 <?php if (isset($_SESSION['identity']) && is_object($_SESSION['identity'])) : ?>
                     <?php if ($_SESSION['identity']->sexo == 'Hombre') : ?>
                         <h3>Bienvenido <?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellido ?></h3>
                     <?php else : ?>
                         <h3>Bienvenida <?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellido ?></h3>
                     <?php endif; ?>
                     <div id="logotipo">
                         <img src="<?= base_url ?>assets/img/Bienvenido.png" />
                     </div>
                     <div id="otro">
                         <ul>
                             <?php if ($_SESSION['identity']->rol == 'admin') : ?>
                                 <li><a href="<?= base_url ?>index.php?controlador=categoria&accion=gestionar">Gestionar
                                         Categorias</a></li><br />
                                 <li><a href="<?= base_url ?>index.php?controlador=producto&accion=gestionar">Gestionar
                                         Productos</a></li><br />
                                 <li><a href="#">Gestionar Pedidos</a></li><br /><br />
                             <?php endif; ?>
                         </ul>

                         <li><a href="<?= base_url ?>index.php?controlador=carrito&accion=index">Ver Pedido</a></li><br />
                         <li><a href="<?= base_url ?>index.php?controlador=carrito&accion=index">Mis Pedidos</a></li><br />
                         <li><a href="<?= base_url ?>index.php?controlador=usuario&accion=ver&id=<?= $_SESSION['identity']->idcliente ?>">Mi
                                 Perfil</a></li><br />
                         <li><a href="<?= base_url ?>index.php?controlador=usuario&accion=logout">Cerrar Sesion</a></li>
                         <br />
                         <?php if ($_SESSION['identity']->rol == 'usuario') : ?>
                             <h3> Carrito de compra</h3>
                             <ul>
                                 <?php $stats = Utils::statscarrito() ?>
                                 <li><a href="<?= base_url ?>index.php?controlador=carrito&accion=index">Productos
                                         Individuales(<?= $stats['productos'] ?>)</a></li><br />
                                 <li><a href="<?= base_url ?>index.php?controlador=carrito&accion=index">Unidades
                                         Totales(<?= $stats['unidades'] ?>)</a></li><br />
                                 <li><a href="<?= base_url ?>index.php?controlador=carrito&accion=index">Total
                                         :$<?= $stats['total'] ?></a></li><br />
                             </ul>
                         <?php endif; ?>
                     <?php elseif (isset($_SESSION['registro'])) : ?>
                         <img height="325px" width="350px" src="<?= base_url ?>assets/img/nuevoU.png" alt="Camiseta logo" />
                         <?phpUtils::deleteSession('registro'); ?>
                     <?php endif; ?>
                     </div>
         </aside>
     </div>
     <div id="central">