<?php
require_once 'modelos/empresa.php';
require_once "modelos/producto.php";
require_once 'modelos/usuario.php';
require_once 'modelos/orden.php';
require_once 'modelos/detalleorden.php';
class carritocontrolador
{

    public function index()
    {
        if (isset($_SESSION['carrito'])) {
            $carrito = $_SESSION['carrito'];
        }
        require_once 'views/carrito/ver.php';
    }

    public function add()
    {
        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
        } else {
            //header('Location:' . base_url . 'index.php');
            echo '<script>window.location="' . base_url . 'index.php?controlador=producto&accion=index"</script>';
        }

        if (isset($_SESSION['carrito'])) {
            $count = 0;
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                if ($elemento['idproducto'] == $producto_id) {
                    //verificando si sobrepasa cantidad
                    $producto = new Producto();
                    $producto->setId($elemento['idproducto']);
                    $producto = $producto->getOne();
                    if (is_object($producto)) {
                        $_SESSION['carrito'][$indice]['unidades']++;
                        $count++;
                    }
                }
            }
        }

        if (!isset($count) || $count == 0) {
            //Conseguir producto
            $producto = new Producto();
            $producto->setId($producto_id);
            $producto = $producto->getOne();

            if (is_object($producto)) {
                $_SESSION['carrito'][] = array(
                    "idproducto" => $producto->idproducto,
                    "precio" => $producto->precio,
                    "unidades" => 1,
                    "producto" => $producto
                );
            }
        }
        //header('Location:' . base_url . 'index.php?controlador=carrito&accion=index');
        echo '<script>window.location="' . base_url . 'index.php?controlador=carrito&accion=index"</script>';
    }
    public function deleteproducto()
    {
        $producto_id = $_GET['id'];
        foreach ($_SESSION['carrito'] as $indice => $elemento) {
            if ($elemento['idproducto'] == $producto_id) {
                $_SESSION['carrito'][$indice]['unidades']--;

                if ($_SESSION['carrito'][$indice]['unidades'] == 0) {
                    unset($_SESSION['carrito'][$indice]);
                }

                if ($_SESSION['carrito'] == null) {
                    unset($_SESSION['carrito']);
                }
            }
        }
        //header('Location:' . base_url . 'index.php?controlador=carrito&accion=index');
        echo '<script>window.location="' . base_url . 'index.php?controlador=carrito&accion=index"</script>';
    }

    public function delete()
    {
        unset($_SESSION['carrito']);
        echo '<script>window.location="' . base_url . 'index.php?controlador=carrito&accion=index"</script>';
    }

    public function hacerpago()
    {
        Utils::deleteSession('cerrado');
        $empresa = new Empresa();
        $empresa = $empresa->verificar();
        if (is_object($empresa)) {
            if ($empresa->estado != 'Activo') {
                $_SESSION['cerrado'] = true;
            }
        } else {
            $_SESSION['cerrado'] = true;
        }
        require_once 'views/carrito/hacerpago.php';
    }

    public function errorsesion()
    {
        Utils::deleteSession('error_login');
        Utils::deleteSession('carrito');
        unset($_SESSION['error_login']);
        unset($_SESSION['carrito']);
        $_SESSION['nuevouser'] = true;
        $_SESSION['registro2'] = true;
        require_once 'views/usuario/registro.php';
    }



    public function canceladopaypal()
    {
        $_SESSION['paypal'] = $_REQUEST;
        if (isset($_GET['idcliente'])) {
            $id = $_GET['idcliente'];
            $user = new Usuario();
            $user->setId($id);
            $identity = $user->getOne();
            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;
                if ($identity->rol == 'admin') {
                    $_SESSION['admin'] = true;
                } elseif ($identity->rol == 'usuario') {
                    $_SESSION['admin'] = false;
                    $_SESSION['user'] = true;
                }
            }
            if (isset($_SESSION['paypal']) && isset($_GET['idorden'])) {
                $id = $_GET['idorden'];
                $orden = new Orden();
                $orden->setIdorden($id);
                $orden->setCorreopaypal($_SESSION['paypal']['payer_email']);
                $paypal = $orden->updatecorreopay();
            }
            if ($paypal) {
                $_SESSION['pedidohecho'] = 'paypal';
                unset($_SESSION['carrito']);
            }

            echo '<script>window.location="' . base_url . 'index.php?controlador=carrito&accion=index"</script>';
        }
        if (isset($_GET['carrito'])) {
            $stats = Utils::statscarrito();
            //Llenar pedido 
            $cliente = $_SESSION['identity']->idcliente;
            $latitud = $_SESSION['identity']->latitud;
            $longitud = $_SESSION['identity']->longitud;
            $costoT = $stats['total'];

            $orden = new Orden();
            $orden->setCliente($cliente);
            $orden->setLatitud($latitud);
            $orden->setLongitud($longitud);
            $orden->setCostototal($costoT);
            $orden->setTipopago('paypal');
            $ordenid = $orden->guardar();
            if ($ordenid > 0) {
                //llenar detallepedido
                if (isset($_SESSION['carrito'])) {
                    foreach ($_SESSION['carrito'] as $producto) {
                        $ordendeta = $ordenid;
                        $product = $producto['idproducto'];
                        $precio = $producto['precio'];
                        $cantidad = $producto['unidades'];

                        $detalle = new Detalleorden();
                        $detalle->setOrden($ordendeta);
                        $detalle->setProducto($product);
                        $detalle->setPrecio($precio);
                        $detalle->setCantidad($cantidad);
                        $confi = $detalle->guardar();
                    }
                }
                if ($confi) {
                    echo '<script>window.location="' . base_url . 'index.php?controlador=carrito&accion=pagarpaypal&id=' . $ordenid . '"</script>';
                }
            }
        }
    }

    public function pagarpaypal()
    {
        if (isset($_SESSION['carrito'])) {
            $carrito = $_SESSION['carrito'];
        }
        require_once 'views/carrito/paypal.php';
    }

    public function cancelarpaypal()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $orden = new Orden();
            $orden->setIdorden($id);
            $update = $orden->delete();

            if ($update) {
                echo '<script>window.location="' . base_url . 'index.php?controlador=carrito&accion=hacerpago"</script>';
            }
        }
    }

    public function pagaralrecibir()
    {
        $stats = Utils::statscarrito();
        //Llenar pedido 
        $cliente = $_SESSION['identity']->idcliente;
        $latitud = $_SESSION['identity']->latitud;
        $longitud = $_SESSION['identity']->longitud;
        $costoT = $stats['total'];

        $orden = new Orden();
        $orden->setCliente($cliente);
        $orden->setLatitud($latitud);
        $orden->setLongitud($longitud);
        $orden->setCostototal($costoT);
        $orden->setTipopago('alrecibir');
        $ordenid = $orden->guardar();
        if ($ordenid > 0) {
            //llenar detallepedido
            if (isset($_SESSION['carrito'])) {
                foreach ($_SESSION['carrito'] as $producto) {
                    $ordendeta = $ordenid;
                    $product = $producto['idproducto'];
                    $precio = $producto['precio'];
                    $cantidad = $producto['unidades'];

                    $detalle = new Detalleorden();
                    $detalle->setOrden($ordendeta);
                    $detalle->setProducto($product);
                    $detalle->setPrecio($precio);
                    $detalle->setCantidad($cantidad);
                    $confi = $detalle->guardar();
                }
            }
        }
        if ($confi) {
            unset($_SESSION['carrito']);
            $_SESSION['pedidohecho'] = 'alrecibir';
        }
        echo '<script>window.location="' . base_url . 'index.php?controlador=carrito&accion=index"</script>';
    }
}
