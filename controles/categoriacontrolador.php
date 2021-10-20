<?php
require_once 'modelos/categoria.php';
require_once 'modelos/producto.php';

class categoriacontrolador
{

    public function gestionar()
    {
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        require_once 'views/categoria/categorias.php';
    }

    public function crear()
    {
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function guardar()
    {
        Utils::isAdmin();
        if (isset($_POST)) {
            //Guardar Categorias 
            $nombre = $_POST['nombre'];
            //Guardar imagen
            $categoria = new Categoria();
            $categoria->setNombre($nombre);
            $save = $categoria->save();

            if ($save > 0) {
                $_SESSION['categoria'] = "complete";
            } else {
                $_SESSION['categoria'] = "failed";
            }
        }
        //header('Location:' . base_url . 'index.php?controlador=categoria&accion=crear');
        echo '<script>window.location="' . base_url . 'index.php?controlador=categoria&accion=crear"</script>';
    }

    public function editar()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;
            $categoria = new Categoria();
            $categoria->setIdcategoria($id);
            $cate = $categoria->getOne();

            require_once 'views/categoria/crear.php';
        } else {
            header('Location:' . base_url . 'index.php?controlador=categoria&accion=gestionar');
        }
    }

    public function eliminar()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria->setIdcategoria($id);
            $delete = $categoria->delete();

            if ($delete) {
                $_SESSION['delete'] = 'complete';
            } else {
                $_SESSION['delete'] = 'failed';
            }
        } else {
            $_SESSION['delete'] = 'failed';
        }

        //header('Location:' . base_url . 'index.php?controlador=categoria&accion=gestionar');
        echo '<script>window.location="' . base_url . 'index.php?controlador=categoria&accion=gestionar"</script>';
    }

    public function edit()
    {
        Utils::isAdmin();
        if (isset($_GET['id']) && isset($_POST)) {
            $id = $_GET['id'];
            $nombre = $_POST['nombre'];

            $categoria = new Categoria();
            $categoria->setNombre($nombre);

            $categoria->setIdcategoria($id);
            $delete = $categoria->update();

            if ($delete) {
                $_SESSION['update'] = 'complete';
            } else {
                $_SESSION['update'] = 'failed';
            }
        } else {
            $_SESSION['update'] = 'failed';
        }

        //header('Location:' . base_url . 'index.php?controlador=categoria&accion=gestionar');
        echo '<script>window.location="' . base_url . 'index.php?controlador=categoria&accion=gestionar"</script>';
    }


    public function ver()
    {
        if (isset($_GET['id'])) {
            //Obtener Categoria
            $id = $_GET['id'];
            $categoria = new Categoria();
            $categoria->setIdcategoria($id);
            $categoria = $categoria->getOne();

            //Obtener Producto
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategory();
        }
        require_once 'views/categoria/ver.php';
    }
}
