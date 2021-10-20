<?php

require_once 'modelos/usuario.php';
class usuariocontrolador
{

   public function bienbenida()
   {
      require_once 'views/usuario/bienbenida.php';
   }

   public function registro()
   {
      Utils::deleteSession('cambiarubi');
      Utils::deleteSession('cambiar');
      Utils::deleteSession('error_login');
      Utils::deleteSession('correofailed');

      require_once 'views/usuario/registro.php';
   }

   public function gestionar()
   {
      Utils::isAdmin();
      //Obtener Usuarios
      $user = new Usuario();
      $users = $user->getAll();

      if ($users->num_rows == 0) {
         $_SESSION['nouser'] = true;
      }

      require_once 'views/usuario/gestionar.php';
   }

   public function save()
   {
      $regex = "/^[a-zA-Z\d]+@[a-zA-Z\d]+\.[a-zA-Z\d\.]{2,3}+$/";
      if (isset($_POST)) {
         $corre = isset($_POST['correoN']) ? $_POST['correoN'] : false;
         if (preg_match($regex, $corre)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : false;
            $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : false;
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
            $dui = isset($_POST['dui']) ? $_POST['dui'] : false;
            $correpN = isset($_POST['correoN']) ? $_POST['correoN'] : false;
            $longitud = isset($_POST['longitud']) ? $_POST['longitud'] : false;
            $latitud = isset($_POST['latitud']) ? $_POST['latitud'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            $rol = "usuario";
            //Guardar imagen
            if ($_FILES['imagen'] != null) {
               $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
            } else {
               $imagen = '';
            }
            //Guardar imagen

            if ($nombre && $apellido && $sexo && $telefono && $dui && $correpN && $longitud && $latitud && $password) {
               $codigo = Utils::codigoseguridad();
               $usuario = new Usuario();
               $usuario->setNombre($nombre);
               $usuario->setApellido($apellido);
               $usuario->setSexo($sexo);
               $usuario->setTelefono($telefono);
               $usuario->setDui($dui);
               $usuario->setCorreo($correpN);
               $usuario->setLongitud($longitud);
               $usuario->setLatitud($latitud);
               $usuario->setPassword(Utils::encriptacion($password));
               $usuario->setRol($rol);
               if ($imagen != '') {
                  $usuario->setImagen($imagen);
               }
               $usuario->setCodigore($codigo);
               $confi = $usuario->confirmarcorreo();
               $conficorreo = false;
               while ($correos = $confi->fetch_object()) {
                  if ($correos->correonormal == $correpN) {
                     $conficorreo = true;
                  }
               }
               if ($conficorreo == false) {
                  $save = $usuario->guardar();
                  if ($save > 0) {
                     $_SESSION['register'] = "complete";
                     $confir = $usuario->confirmacion();
                     if ($confir) {
                        $_SESSION['confirmacion'] = "complete";
                     } else {
                        $_SESSION['confirmacion'] = "failed";
                     }
                  } else {
                     $_SESSION['register'] = "failed";
                  }
               } else {
                  $_SESSION['correo'] = "correofailed";
               }
            } else {
               $_SESSION['register'] = "failed";
            }
         } else {
            $_SESSION['correo'] = "failedcorreo";
            echo '<script>window.location="' . base_url . 'index.php?controlador=usuario&accion=registro"</script>';
         }
      } else {
         $_SESSION['register'] = "failed";
      }
      //header('Location:' . base_url . 'index.php?controlador=usuario&accion=registro');
      echo '<script>window.location="' . base_url . 'index.php?controlador=usuario&accion=registro"</script>';
   }

   public function confirmarcuenta()
   {
      Utils::deleteSession('confirmacion');
      if (isset($_GET['idusuario'])) {
         $id = $_GET['idusuario'];
         $usuario = new Usuario();
         $usuario->setId($id);
         $confirmacion = $usuario->activacion();

         if ($confirmacion == true) {
            $_SESSION['confirmada'] = true;
         } else {
            $_SESSION['noconfirmada'] = true;
         }
         echo '<script>window.location="' . base_url . 'index.php?controlador=usuario&accion=confirmado"</script>';
      }
   }

   public function confirmado()
   {
      require_once 'views/usuario/Iniciosesion.php';
   }

   public function contrasenia()
   {
      require_once 'views/usuario/recuperarcontra.php';
   }

   public function contraseniacambio()
   {
      require_once 'views/usuario/cambiocontra.php';
   }

   public function contrasenia_()
   {
      Utils::deleteSession('opcioncontra');
      Utils::deleteSession('usuario');
      Utils::deleteSession('error_contra');
      Utils::deleteSession('contracomplete');

      if (isset($_SESSION['opcioncontra'])) {
         unset($_SESSION['opcioncontra']);
      }

      if (isset($_SESSION['usuario'])) {
         unset($_SESSION['usuario']);
      }

      if (isset($_SESSION['error_contra'])) {
         unset($_SESSION['error_contra']);
      }

      if (isset($_SESSION['contracomplete'])) {
         unset($_SESSION['contracomplete']);
      }
      require_once 'views/usuario/recuperarcontra.php';
   }

   public function opcioncambio()
   {
      if (isset($_GET['opcion'])) {
         $opcion = $_GET['opcion'];

         if ($opcion == 'cambiar') {
            $_SESSION['opcioncontra'] = 'cambiar';
         } else {
            $_SESSION['opcioncontra'] = 'recuperar';
         }
         echo '<script>window.location="' . base_url . 'index.php?controlador=usuario&accion=contrasenia"</script>';
      }
   }

   public function procesocambio()
   {
      if (isset($_GET['opcion'])) {
         $opcion = $_GET['opcion'];

         if ($opcion == 'cambiar') {
            $_SESSION['opcioncontra'] = 'cambiar';
            $usuario = new Usuario();
            $usuario->setCorreo($_POST['correo']);
            $usuario->setDui($_POST['dui']);
            $buscar = $usuario->buscarusuario();

            if (is_object($buscar) && $buscar) {
               $_SESSION['usuario'] = $buscar;
            } else {
               $_SESSION['usuario'] = 'no';
            }
         } else {
            $_SESSION['opcioncontra'] = 'recuperar';
            $usuario = new Usuario();
            $usuario->setCorreo($_POST['correo']);
            $usuario->setDui($_POST['dui']);
            $buscar = $usuario->buscarusuario2();

            if (is_object($buscar)) {
               $_SESSION['usuario'] = $buscar;
               $usuario = new Usuario();
               $usuario->setCorreo($buscar->correonormal);
               $usuario->setPassword($buscar->contrasenia);
               $enviado = $usuario->enviarcontra();

               if ($enviado) {
                  $_SESSION['contraenviada'] = true;
                  Utils::deleteSession('error_login');
               } else {
                  $_SESSION['contraenviada'] = false;
               }
            } else {
               $_SESSION['usuario'] = 'no';
            }
         }
         echo '<script>window.location="' . base_url . 'index.php?controlador=usuario&accion=contrasenia"</script>';
      }
   }

   public function procesocambio2()
   {
      if (isset($_GET['opcion'])) {
         $opcion = $_GET['opcion'];

         if ($opcion == 'cambiar') {
            $_SESSION['opcioncontra'] = 'cambiar';
            $usuario = new Usuario();
            $usuario->setCorreo($_POST['correo']);
            $usuario->setDui($_POST['dui']);
            $usuario->setCodigore($_POST['codigo']);
            $buscar = $usuario->confirmarcodigo();

            if (is_object($buscar) && $buscar) {
               $_SESSION['usuario'] = $buscar;
            } else {
               $_SESSION['usuario'] = 'no';
            }
         }
         echo '<script>window.location="' . base_url . 'index.php?controlador=usuario&accion=contraseniacambio"</script>';
      }
   }

   public function cambiocontra()
   {
      if (isset($_GET['idcliente'])) {
         $id = $_GET['idcliente'];
         $password1 = $_POST['password_1'];
         $password2 = $_POST['password_2'];
         if ($password1 == $password2) {
            $usuario = new Usuario();
            $usuario->setId($id);
            $usuario->setPassword(Utils::encriptacion($password1));
            $cambio = $usuario->cambiocontra();
            if ($cambio) {
               $_SESSION['contracomplete'] = true;
               Utils::deleteSession('error_login');
               Utils::deleteSession('error_contra');
            }
         } else {
            $_SESSION['error_contra'] = true;
         }
      }
      echo '<script>window.location="' . base_url . 'index.php?controlador=usuario&accion=contraseniacambio"</script>';
   }


   public function login()
   {
      if (isset($_POST)) {
         //IDENTIFICAR AL USUARIO
         //CONSULTA A LA BASE DE DATOSz
         Utils::deleteSession('error_login');
         $usuario = new Usuario();
         $usuario->setCorreo($_POST['usuario']);
         $usuario->setPassword($_POST['password']);
         $identity = $usuario->login();

         if ($identity && is_object($identity)) {
            $_SESSION['identity'] = $identity;
            if ($identity->rol == 'admin') {
               $_SESSION['admin'] = true;
            } elseif ($identity->rol == 'usuario') {
               //$_SESSION['admin'] = false;
               $_SESSION['user'] = true;
            }
         } else {
            $_SESSION['error_login'] = true;
         }
         //CREAR UNA SESION
         //header('Location:' . base_url . 'index.php');
         echo '<script>window.location="' . base_url . 'index.php?controlador=producto&accion=index"</script>';
      }
   }

   public function logout()
   {
      Utils::deleteSession('identity');
      Utils::deleteSession('admin');
      Utils::deleteSession('user');
      Utils::deleteSession('carrito');
      Utils::deleteSession('error_login');
      Utils::deleteSession('contraenviada');

      if (isset($_SESSION['identity'])) {
         unset($_SESSION['identity']);
      }

      if (isset($_SESSION['admin'])) {
         unset($_SESSION['admin']);
      }

      if (isset($_SESSION['user'])) {
         unset($_SESSION['user']);
      }

      if (isset($_SESSION['carrito'])) {
         unset($_SESSION['carrito']);
      }

      if (isset($_SESSION['error_login'])) {
         unset($_SESSION['error_login']);
      }

      if (isset($_SESSION['contraenviada'])) {
         unset($_SESSION['contraenviada']);
      }
      //header('Location:' . base_url . 'index.php');
      echo '<script>window.location="' . base_url . 'index.php"</script>';
   }

   public function ver()
   {
      Utils::isAdmin();
      if (isset($_GET['id'])) {
         //Obtener Categoria
         $id = $_GET['id'];
         $user = new Usuario();
         $user->setId($id);
         $user = $user->getOne();
      }
      require_once 'views/usuario/ver.php';
   }

   public function editar()
   {
      Utils::deleteSession('cambiarubi');
      Utils::deleteSession('cambiar');
      Utils::isAdmin();
      if (isset($_GET['id'])) {
         //Obtener Categoria
         $edit = true;
         $id = $_GET['id'];
         $meto = $_GET['cambiar'];
         $user = new Usuario();
         $user->setId($id);
         $user = $user->getOne();
         if ($meto == 'ubi') {
            $_SESSION['cambiarubi'] = true;
         }
         if ($meto == 'todo') {
            $_SESSION['cambiar'] = true;
         }
         require_once 'views/usuario/registro.php';
      } else {
         header('Location:' . base_url . 'index.php');
      }
   }

   public function edit()
   {
      Utils::isAdmin();

      if (isset($_POST) && isset($_GET['id'])) {
         $id = $_GET['id'];
         $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
         $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : false;
         $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : false;
         $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
         $dui = isset($_POST['dui']) ? $_POST['dui'] : false;
         $correpN = isset($_POST['correoN']) ? $_POST['correoN'] : false;
         $longitud = isset($_POST['longitud']) ? $_POST['longitud'] : false;
         $latitud = isset($_POST['latitud']) ? $_POST['latitud'] : false;
         $password = isset($_POST['password']) ? $_POST['password'] : false;
         $rol = "usuario";
         //Guardar imagen
         if ($_FILES['imagen'] != null) {
            $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));
         } else {
            $imagen = '';
         }
         //Guardar imagen

         $usuario = new Usuario();
         $usuario->setId($id);
         $usuario->setNombre($nombre);
         $usuario->setApellido($apellido);
         $usuario->setSexo($sexo);
         $usuario->setTelefono($telefono);
         $usuario->setDui($dui);
         $usuario->setCorreo($correpN);
         $usuario->setLongitud($longitud);
         $usuario->setLatitud($latitud);
         $usuario->setPassword(Utils::encriptacion($password));
         $usuario->setRol($rol);
         if ($imagen != '') {
            $usuario->setImagen($imagen);
         }
         $update = $usuario->update();
         $user = $usuario->getOne();

         if ($update) {
            $_SESSION['identity'] = $user;
            $_SESSION['register'] = "complete";
         } else {
            $_SESSION['register'] = "failed";
         }
      } else {
         $_SESSION['register'] = "failed";
      }
      //header('Location:' . base_url . 'index.php?controlador=usuario&accion=registro');
      if (isset($_SESSION['cambiarubi'])) {
         unset($_SESSION['cambiarubi']);
         unset($_SESSION['confirmacion']);
         unset($_SESSION['register']);
         echo '<script>window.location="' . base_url . 'index.php?controlador=carrito&accion=hacerpago"</script>';
      } else {
         echo '<script>window.location="' . base_url . 'index.php?controlador=usuario&accion=ver&id=' . $id . '"</script>';
      }
   }

   public function eliminar()
   {
      Utils::isAdmin();
      if (isset($_GET['id'])) {
         //Obtener Usuarios
         $id = $_GET['id'];
         $user = new Usuario();
         $user->setId($id);
         $user->eliminar();
         $users = $user->getAll();
         if ($users->num_rows == 0) {
            $_SESSION['nouser'] = true;
         }
      }
      require_once 'views/usuario/gestionar.php';
   }
}//fin de clase