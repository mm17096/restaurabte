<?php

require_once 'modelos/producto.php';
require_once 'modelos/orden.php';
require_once 'modelos/detalleorden.php';
class productocontrolador
{

    public function index()
    {
        $producto = new Producto();
        $product = $producto->getRandom();
        $ordenes = new Orden();
        require_once 'views/producto/destacados.php';
    }

    public function gestionar()
    {
        Utils::isAdmin();
        $producto = new Producto();
        $productos = $producto->getAll();
        require_once 'views/producto/gestionar.php';
    }

    public function crear()
    {
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }

    public function ver()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);
            $product = $producto->getOne();
        }
        require_once 'views/producto/ver.php';
    }

    public function save()
    {
        Utils::isAdmin();
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $disponible = isset($_POST['disponible']) ? $_POST['disponible'] : false;
            //Guardar imagen
            if (isset($_FILES['imagen']) != null) {
                $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
            } else {
                $imagen = '';
            }
            //Guardar imagen
            if ($nombre && $descripcion && $precio > 0 && $categoria && $disponible) {
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setCategoria_id($categoria);
                $producto->setDisponible($disponible);
                if ($imagen != '') {
                    $producto->setImagen($imagen);
                }
                $save = $producto->save();

                if ($save > 0) {
                    $_SESSION['producto'] = "complete";
                } else {
                    $_SESSION['producto'] = "failed";
                }
            } else {
                $_SESSION['producto'] = "failed";
            }
        } else {
            $_SESSION['producto'] = "failed";
        }
        //header('Location:' . base_url . 'index.php?controlador=producto&accion=crear');
        echo '<script>window.location="' . base_url . 'index.php?controlador=producto&accion=crear"</script>';
    }

    public function editar()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;
            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();


            require_once 'views/producto/crear.php';
        } else {
            header('Location:' . base_url . 'index.php?controlador=producto&accion=gestionar');
        }
    }

    public function eliminar()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);
            $delete = $producto->delete();

            if ($delete) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }

        //header('Location:' . base_url . 'index.php?controlador=producto&accion=gestionar');
        echo '<script>window.location="' . base_url . 'index.php?controlador=producto&accion=gestionar"</script>';
    }

    public function edit()
    {
        Utils::isAdmin();

        if (isset($_GET['id']) && isset($_POST['nombre'])) {
            $id = $_GET['id'];
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $disponible = isset($_POST['disponible']) ? $_POST['disponible'] : false;
            //Guardar imagen 
            if ($_FILES['imagen'] != null) {
                $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
            } else {
                $imagen = '';
            }
            //Guardar imagen

            $producto = new Producto();
            $producto->setNombre($nombre);
            $producto->setDescripcion($descripcion);
            $producto->setPrecio($precio);
            $producto->setCategoria_id($categoria);
            $producto->setDisponible($disponible);
            if ($imagen != '') {
                $producto->setImagen($imagen);
            }
            $producto->setId($id);

            $update = $producto->update();

            if ($update) {
                $_SESSION['update'] = 'complete';
            } else {
                $_SESSION['update'] = 'failed';
            }
        } else {
            $_SESSION['update'] = 'failed';
        }

        //header('Location:' . base_url . 'index.php?controlador=producto&accion=gestionar');
        echo '<script>window.location="' . base_url . 'index.php?controlador=producto&accion=gestionar"</script>';
    }
}
