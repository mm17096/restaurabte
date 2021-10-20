<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/Exception.php';
require_once 'PHPMailer/src/SMTP.php';

class Usuario
{
    private $id;
    private $nombre;
    private $apellido;
    private $sexo;
    private $imagen;
    private $telefono;
    private $latitud;
    private $longitud;
    private $password;
    private $rol;
    private $dui;
    private $correo;
    private $codigore;

    /**
     * Get $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get $nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get $apellido
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Get $sexo
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Get $imagen
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Get $telefono
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Get $latitud
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Get $longitud
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Get $password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get $rol
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Get $dui
     */
    public function getDui()
    {
        return $this->dui;
    }

    /**
     * Get $correo
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Get $codigore
     */
    public function getCodigore()
    {
        return $this->codigore;
    }

    /**
     * Set $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Set $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Set $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * Set $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * Set $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    /**
     * Set $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * Set $latitud
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;
    }

    /**
     * Set $longitud
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;
    }

    /**
     * Set $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Set $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    /**
     * Set $dui
     */
    public function setDui($dui)
    {
        $this->dui = $dui;
    }

    /**
     * Set $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * Set $codigore
     */
    public function setCodigore($codigore)
    {
        $this->codigore = $codigore;
    }

    public function guardar()
    {
        $Db = Database::connect();
        $save = $Db->query("INSERT INTO `cliente`(`nombre`, `apellido`, `sexo`, `imagen`, `telefono`, `latitud`, `longitud`, `contrasenia`, `rol`, `dui`, `correonormal`, `confirmacion`) 
        VALUES('{$this->getNombre()}', '{$this->getApellido()}', '{$this->getSexo()}', '{$this->getImagen()}', '{$this->getTelefono()}', '{$this->getLatitud()}', '{$this->getLongitud()}', '{$this->getPassword()}', '{$this->getRol()}', '{$this->getDui()}', '{$this->getCorreo()}', 'NO')");

        $idusuario = $Db->insert_id;
        $this->setId($idusuario);
        $resultado = false;
        if ($save) {
            $resultado = true;
        }
        return $resultado;
    }

    public function getAll()
    {
        //Consiguiendo objeto de usuario
        $Db = Database::connect();
        $save = $Db->query("SELECT * FROM cliente WHERE rol = 'usuario'");
        $resultado = false;
        if ($save) {
            $resultado = $save;
        }
        return $resultado;
    }

    public function getOne()
    {
        //Consiguiendo objeto de usuario
        $Db = Database::connect();
        $save = $Db->query("SELECT * FROM cliente WHERE idcliente = '{$this->getId()}'");
        $resultado = false;
        if ($save) {
            $resultado = $save;
        }
        return $resultado->fetch_object();
    }

    public function confirmarcorreo()
    {
        $resultado = false;
        $Db = Database::connect();
        $buscar = $Db->query("SELECT * FROM `cliente`");

        if ($buscar) {
            $resultado = $buscar;
        }
        return $resultado;
    }

    public function confirmacion()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '587';
        $mail->Username = 'restaurantequevaquerer@gmail.com';
        $mail->Password = 'quevaquerer123';

        $mail->setFrom('restaurantequevaquerer@gmail.com', 'Restaurante Quevaquerer');
        $mail->addAddress($this->getCorreo(), 'Nuevo Usuario');
        $mail->Subject = 'Confirmacion de Cuenta';
        $mail->Body = "
        !Gracias por registrarte {$this->getNombre()} {$this->getApellido()} en Restaurante Quevaquerer¡
        Tu cuenta ha sido creada, ahora puedes registrarte con los datos que nos has proporcionado una vez que actives tu cuenta con el link que esta abajo
        
        Ingresa en el siguiente link para activar tu cuenta....
        http://localhost/RestauranteQuevaquerer/index.php?controlador=usuario&accion=confirmarcuenta&idusuario={$this->getId()}
        
        ";
        $resultado = false;
        if ($mail->send()) {
            $resultado = true;
        }
        return $resultado;
    }

    public function activacion()
    {
        $resultado = false;
        $Db = Database::connect();
        $Db->query("UPDATE `cliente` SET `confirmacion`='SI' WHERE idcliente ='{$this->getId()}'");
        $idusuario = $Db->affected_rows;
        if ($idusuario != 0) {
            $resultado = true;
        }
        return $resultado;
    }

    public function login()
    {
        $result = false;
        $user = $this->correo;
        $password = $this->password;
        //COMPROBAR SI EXITE EL USUARIO
        $Db = Database::connect();
        $login = $Db->query("SELECT * FROM cliente WHERE correonormal = '$user' AND confirmacion = 'SI'");

        if ($login && $login->num_rows == 1) {
            $usuario = $login->fetch_object();
            //VERIFICAR LA CONTRASENIA
            $verify = Utils::desencriptacion($usuario->contrasenia);
            if ($verify == $password) {
                $result = $usuario;
            }
            return $result;
        }
        return $result;
    }

    public function buscarusuario()
    {
        $result = false;
        //COMPROBAR SI EXITE EL USUARIO
        $Db = Database::connect();
        $usuario = $Db->query("SELECT * FROM cliente WHERE correonormal = '{$this->getCorreo()}' AND dui = '{$this->getDui()}'");

        if ($usuario) {
            $result = $usuario;
            $codigo = Utils::codigoseguridad();

            $this->setCodigore($codigo);
            $codigoup = $Db->query("UPDATE `cliente` SET `codigore` = '{$this->getCodigore()}' WHERE correonormal = '{$this->getCorreo()}' AND dui = '{$this->getDui()}'");
            if ($codigoup) {
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'tls';
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = '587';
                $mail->Username = 'restaurantequevaquerer@gmail.com';
                $mail->Password = 'quevaquerer123';

                $mail->setFrom('restaurantequevaquerer@gmail.com', 'Restaurante Quevaquerer');
                $mail->addAddress($this->getCorreo(), 'Usuario');
                $mail->Subject = 'Cambiar contrasenia';
                $mail->Body = "
                Estas en proceso de cambiar tu contraseña...
                Utiliza el siguiente codigo de seguridad para 
                seguir con el proceso de cambiar tu contraseña
        
                Ingresa el siguiente codigo para seguir con 
                el proceso....
                Codigo de Seguridad: {$this->getCodigore()}
                ";

                if ($mail->send()) {
                    return $result->fetch_object();
                } else {
                    $result = false;
                    return $result;
                }
            } else {
                $result = false;
                return $result;
            }
        } else {
            return $result;
        }
    }

    public function confirmarcodigo()
    {
        $result = false;
        //COMPROBAR SI EXITE EL USUARIO Y CODIGO
        $Db = Database::connect();
        $usuario = $Db->query("SELECT * FROM cliente WHERE correonormal = '{$this->getCorreo()}' AND dui = '{$this->getDui()}'AND `codigore` = '{$this->getCodigore()}'");
        if ($usuario) {
            $result = $usuario;
            return $result->fetch_object();
        } else {
            return $result;
        }
    }

    public function cambiocontra()
    {
        $Db = Database::connect();
        $save =  $Db->query("UPDATE `cliente` SET `contrasenia` = '{$this->getPassword()}' WHERE `idcliente`='{$this->getId()}'");

        $resultado = false;
        if ($save) {
            $resultado = true;
        }

        return $resultado;
    }

    public function buscarusuario2()
    {
        $result = false;
        //COMPROBAR SI EXITE EL USUARIO
        $Db = Database::connect();
        $usuario = $Db->query("SELECT * FROM cliente WHERE correonormal = '{$this->getCorreo()}' AND dui = '{$this->getDui()}'");

        if ($usuario) {
            $result = $usuario;
            return $result->fetch_object();
        }
        return $result;
    }

    public function enviarcontra()
    {
        $result = false;
        $contra = Utils::desencriptacion($this->getPassword());
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '587';
        $mail->Username = 'restaurantequevaquerer@gmail.com';
        $mail->Password = 'quevaquerer123';

        $mail->setFrom('restaurantequevaquerer@gmail.com', 'Restaurante Quevaquerer');
        $mail->addAddress($this->getCorreo(), 'Usuario');
        $mail->Subject = 'Cambiar contrasenia';
        $mail->Body = "
            Has completado el proceso de recuperar tu contraseña...
            Tu contraseña es la siguiente
            ------------------------------
            Contraseña: $contra
            ------------------------------
            ";
        if ($mail->send()) {
            $result = true;
        }
        return $result;
    }

    public function enviarnegacion()
    {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '587';
        $mail->Username = 'restaurantequevaquerer@gmail.com';
        $mail->Password = 'quevaquerer123';

        $mail->setFrom('restaurantequevaquerer@gmail.com', 'Restaurante Quevaquerer');
        $mail->addAddress($this->getCorreo(), 'Usuario');
        $mail->Subject = 'Negacion de Pedido';
        $mail->Body = "
        Disculpe estimado cliente pero lastimosamente no podemos enviar su pedido debido a la ubicacion que ha especificaco.
        Intente hacer su pedido nuevamente con una ubicacion diferente; por su comprensión muchas gracias.
        Si usted ha pagado ya su pedido en PayPal, se hara la transferencia respectiva a su cuenta por medio del correo que utilizo  
        ";
        if ($mail->send()) {
            $result = true;
        }
        return $result;
    }

    public function update()
    {
        $Db = Database::connect();
        if ($this->getImagen() == '') {
            $save =  $Db->query("UPDATE `cliente` SET `nombre`='{$this->getNombre()}',`apellido`='{$this->getApellido()}',`sexo`='{$this->getSexo()}',`telefono`='{$this->getTelefono()}',`latitud`='{$this->getLatitud()}',`longitud`='{$this->getLongitud()}',`contrasenia`='{$this->getPassword()}',`dui`='{$this->getDui()}',`correonormal`='{$this->getCorreo()}' WHERE `idcliente`='{$this->getId()}'");
        } else {
            $save =  $Db->query("UPDATE `cliente` SET `nombre`='{$this->getNombre()}',`apellido`='{$this->getApellido()}',`sexo`='{$this->getSexo()}',`imagen`='{$this->getImagen()}',`telefono`='{$this->getTelefono()}',`latitud`='{$this->getLatitud()}',`longitud`='{$this->getLongitud()}',`contrasenia`='{$this->getPassword()}',`dui`='{$this->getDui()}',`correonormal`='{$this->getCorreo()}' WHERE `idcliente`='{$this->getId()}'");
        }
        $resultado = false;
        if ($save) {
            $resultado = true;
        }

        return $resultado;
    }

    public function updateubi()
    {
        $Db = Database::connect();
        $save =  $Db->query("UPDATE `cliente` SET `latitud`='{$this->getLatitud()}',`longitud`='{$this->getLongitud()}' WHERE `idcliente`='{$this->getId()}'");

        $resultado = false;
        if ($save) {
            $resultado = true;
        }

        return $resultado;
    }

    public function eliminar()
    {
        //Consiguiendo objeto de usuario
        $Db = Database::connect();
        $save = $Db->query("DELETE FROM `cliente` WHERE idcliente = '{$this->getId()}'");
        $resultado = false;
        if ($save) {
            $resultado = $save;
        }
        return $resultado;
    }
}
