<?php
session_start();
require_once 'autoload.php';
require_once 'configuracion/db.php';
require_once 'configuracion/parametros.php';
require_once 'helpers/utils.php';
require_once 'views/layout/header.php';
if (isset($_SESSION['registro'])) {
    Utils::deleteSession('registro');
}
if (isset($_GET['controlador']) && isset($_GET['accion'])) {
    if ($_GET['controlador'] == 'usuario' && $_GET['accion'] == 'registro') {
        Utils::deleteSession('error_login');
        $_SESSION['registro'] = true;
    }
}

require_once 'views/layout/sidebar.php';

function show_error()
{
    $error = new errorControlador();
    $error->index();
}

if (isset($_GET['controlador']) && isset($_GET['accion'])) {

    $db = Database::connect();

    if (isset($_GET['controlador'])) {
        $nombre_controlador = $_GET['controlador'] . 'controlador';
    } elseif (!isset($_GET['controlador']) && !isset($_GET['accion'])) {
        $nombre_controlador = controler_default;
    } else {
        show_error();
        exit();
    }

    if (class_exists($nombre_controlador)) {
        $controlador = new $nombre_controlador;

        if (isset($_GET['accion'])) {
            $action = $_GET['accion'];
            $controlador->$action();
        } elseif (!isset($_GET['controlador']) && !isset($_GET['accion'])) {
            $action_default = action_default;
            $controlador->$action_default();
        } else {
            show_error();
        }
    } else {
        show_error();
    }
} else {
    echo '<script>window.location="' . base_url . 'index.php?controlador=producto&accion=index"</script>';
}
require_once 'views/layout/footer.php';
