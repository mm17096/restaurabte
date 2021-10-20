<?php
require_once 'modelos/usuario.php';
require_once 'modelos/orden.php';
require_once 'modelos/detalleorden.php';
class pedidocontrolador
{

    public function index()
    {
        echo "Controlador de Pedido, Accion index";
    }

    public function gestionar()
    {
        Utils::isAdmin();
        if (isset($_GET['tipo'])) {
            $tipo = $_GET['tipo'];
            $orden = new Orden();
            $orden->setEstado($tipo);
            $ordenes = $orden->getAll();

            if ($tipo == 'Entregado' && $ordenes->num_rows != 0) {
                $_SESSION['entregados'] = true;
            }

            if ($ordenes->num_rows == 0 && $tipo == 'Pendiente') {
                $_SESSION['nopendientes'] = true;
                $orden->setEstado('Entregado');
                $ordenes = $orden->getAll();
                if ($ordenes->num_rows == 0) {
                    $_SESSION['noordenes'] = true;
                } else {
                    $_SESSION['entregados'] = true;
                }
            } elseif ($ordenes->num_rows == 0 && $tipo == 'Entregado') {
                $_SESSION['noentregados'] = true;
                $orden->setEstado('Pendiente');
                $ordenes = $orden->getAll();
            }

            require_once 'views/pedidos/gestionar.php';
        }
    }

    public function ver()
    {
        Utils::deleteSession('emp');
        Utils::deleteSession('user');
        Utils::deleteSession('gestion');
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            //Obtener los detalles de la Orden
            $detalle = new Detalleorden();
            $detalle->setOrden($id);
            $detalles = $detalle->getOne();
            //Obtener la Orden
            $orden = new Orden();
            $orden->setIdorden($id);
            $orden = $orden->getOne();
            //Obtener el cliente
            $cliente = new Usuario();
            $cliente->setId($orden->cliente);
            $cliente = $cliente->getOne();
            $_SESSION['orden'] = $orden;
            if (isset($_GET['idem'])) {
                $_SESSION['emp'] = true;
                $idempresa = $_GET['idem'];
            } else if (isset($_GET['iduser'])) {
                $_SESSION['user'] = true;
                $iduser = $_GET['iduser'];
            } else {
                $_SESSION['gestion'] = true;
            }
            require_once 'views/pedidos/ver.php';
        }
    }

    public function editarestado()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $orden = new Orden();
            $orden->setIdorden($id);
            $cambio = $orden->updateestado();
            if ($cambio) {
                $_SESSION['cambio'] = true;
            }
            echo '<script>window.location="' . base_url . 'index.php?controlador=pedido&accion=gestionar&tipo=Pendiente"</script>';
        }
    }

    public function pedidoscliente()
    {
        Utils::deleteSession('gestion');
        Utils::deleteSession('sinpedidos');
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $orden = new Orden();
            $orden->setCliente($id);
            $ordenes = $orden->getAllme();
            if ($ordenes == false) {
                $_SESSION['sinpedidos'] = true;
            }

            if (isset($_GET['tipo'])) {
                $_SESSION['gestion'] = true;
            }
            require_once 'views/pedidos/pedidos.php';
        }
    }

    public function negar(){
        if (isset($_GET['ido'])) {
            $idorden = $_GET['ido'];
            $idcliente = $_GET['idc'];
            $orden = new Orden();
            $orden->setIdorden($idorden);
            $ordenes = $orden->delete();
            $usuario = new Usuario();
            $usuario->setId($idcliente);
             $cliente = $usuario->getOne();
             $usuario->setCorreo($cliente->correonormal);
            $negacion = $usuario->enviarnegacion();
            if ($negacion) {
                $_SESSION['negacion'] = "complete";
             }
    }
    echo '<script>window.location="' . base_url . 'index.php?controlador=pedido&accion=gestionar&tipo=Pendiente"</script>';
}

}