<?php
require_once 'modelos/empresa.php';
require_once 'modelos/orden.php';
require_once 'modelos/detalleorden.php';

class empresacontrolador
{
    public function informacion()
    {
        require_once 'views/empresa/informacion.php';
    }

    public function gestionar()
    {
        Utils::deleteSession('nolaboral');
        Utils::isAdmin();
        $empresa = new Empresa();
        $empresa->actualizar();
        $empresas = $empresa->getAll();

        if ($empresas->num_rows == 0) {
            $_SESSION['nolaboral'] = true;
        }

        require_once 'views/empresa/gestionar.php';
    }


    public function ver()
    {
        if (isset($_GET['id'])) {
            //Obtener dia laborar
            $id = $_GET['id'];
            $empresa = new Empresa();
            $empresa->setId($id);
            $empresa = $empresa->getOne();
            //Obtener ordenes del dirna
            $orden = new Orden();
            $orden->setFecha($empresa->fecha);
            $ordenes = $orden->getAllempresa();
        }
        require_once 'views/empresa/ver.php';
    }

    public function cerrar()
    {
        if (isset($_GET['id'])) {
            //Obtener dia laborar
            $id = $_GET['id'];
            $empresa = new Empresa();
            $empresa->setId($id);
            $empresa->cerrar();
            $empresas = $empresa->getAll();
        }
        require_once 'views/empresa/gestionar.php';
    }

    public function activar()
    {
        if (isset($_GET['id'])) {
            //Obtener dia laborar
            $id = $_GET['id'];
            $empresa = new Empresa();
            $empresa->setId($id);
            $empresa->activar();
            $empresas = $empresa->getAll();
        }
        require_once 'views/empresa/gestionar.php';
    }

    public function nuevodia()
    {
        Utils::deleteSession('existedia');
        Utils::deleteSession('nuevodia');
        $empresa = new Empresa();
        $confirmacion = $empresa->verificar();
        if (is_object($confirmacion)) {
            $_SESSION['existedia'] = true;
        } else {
            $nueva = $empresa->nuevodia();
            if ($nueva) {
                $empresa->terminaranterior();
                $_SESSION['nuevodia'] = true;
            }
        }
        $empresas = $empresa->getAll();
        require_once 'views/empresa/gestionar.php';
    }
}
