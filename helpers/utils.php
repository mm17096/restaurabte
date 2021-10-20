<?php
define('METHOD', 'AES-256-CBC');
define('SECRET_KEY', '$QUEVAQUERER@2020sv');
define('SECRET_IV', '101712');

class Utils
{

    public static function deleteSession($name)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION['$name']);
        }
        return $name;
    }

    public static function isAdmin()
    {
        if (isset($_SESSION['admin']) && $_SESSION['admin'] != false) {
            return true;
        } else {
            if (isset($_SESSION['user']) && $_SESSION['user'] != false) {
                return true;
            } else {
                echo '<script>window.location="' . base_url . 'index.php"</script>';
            }
        }
    }

    public static function showCategorias()
    {
        require_once 'modelos/categoria.php';
        $categoria = new Categoria();
        $categoria = $categoria->getAll();
        return $categoria;
    }

    public static function encriptacion($string)
    {
        $contra = false;
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $contra = openssl_encrypt($string, METHOD, $key, 0, $iv);
        $contra = base64_encode($contra);
        return $contra;
    }

    public static function desencriptacion($string)
    {
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $contra = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $contra;
    }
    public static function statscarrito()
    {
        $stats = array('productos' => 0, 'unidades' => 0, 'total' => 0);
        if (isset($_SESSION['carrito'])) {
            $stats['productos'] = count($_SESSION['carrito']);
            foreach ($_SESSION['carrito'] as $producto) {
                $stats['unidades'] += $producto['unidades'];
                $stats['total'] += $producto['precio'] * $producto['unidades'];
            }
        }
        return $stats;
    }
    public static function codigoseguridad()
    {
        $chars = "0AaBbCc1DdEe2FfGgHh3IiJj4KkLlMm5NnOo6PpQqRr7SsTt8UuVvWwXx9YyZz$";
        $codigo = "";
        for ($i = 0; $i < 10; $i++) {
            //generar numero aleatoreo
            $num = rand(1, strlen($chars));
            //crear contrasenia
            $codigo .= substr($chars, $num - 1, 1);
        }
        return $codigo;
    }
}
