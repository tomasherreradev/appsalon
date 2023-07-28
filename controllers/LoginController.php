<?php

namespace Controller;

use Model\Usuario;
use MVC\Router;
use Classes\Email;

//Auth es utilizado para saber si se obtienen datos de la BD
//En caso de que si, pasa a ser "usuario"


class LoginController {

    public static function login(Router $router){
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if (empty($alertas)) {
                //Comprobar si el usuario existe
                $usuario = Usuario::where('email', $auth->email);
                if ($usuario) {
                    if ($usuario->comprobarPasswordAndVerificado($auth->password)) {
                        //autenticar
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //redireccionar
                        if($usuario->admin === "1") {
                            $_SESSION['admin'] = $usuario->admin ?? null;

                            header('Location: /admin');
                        } else {
                            header('Location: /cita');
                        }
                    }
                } else {
                    Usuario::setAlerta('error', "Usuario no encontrado.");
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('/auth/login', [
            'alertas' => $alertas
        ]);
    }


    

    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }




    public static function olvide(Router $router) {

        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)){
                $usuario = Usuario::where('email', $auth->email);
                if($usuario && $usuario->confirmado === "1") {
                    $usuario->crearToken();
                    $usuario->guardar();
                    Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu e-mail.');

                    //Enviar el mail
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->recuperarPass();
                    
                } else {
                    Usuario::setAlerta('error', 'Cuenta inexistente o no aún no se confirmó.');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('/auth/olvide-pass', [
            'alertas' => $alertas
        ]);
    }



    public static function recuperar(Router $router) {
        $alertas=[];
        $error = false;

        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);
        
        if(empty($usuario)) {
            $alertas = Usuario::setAlerta('error', 'Token no válido');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if(empty($alertas)) {
                $usuario->password = null;
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->guardar();

                if($resultado) {
                    header('Location: /');
                }
                
            }
        }


        $alertas = Usuario::getAlertas();
        $router->render('/auth/recuperar-pass', [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }




    public static function crear(Router $router)
    {
        $usuario = new Usuario();
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //Revisar que alerta esté vacío
            if (empty($alertas)) {
                //Verificar que el usuario no esté registrado
                $resultado = $usuario->existeUsuario();
                if ($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                } else { // Si no está registrado:

                    //hashear pass
                    $usuario->hashPassword();

                    //crear un token
                    $usuario->crearToken();

                    //enviar mail
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email-> enviarConfirmacion();

                    //crear usuario
                    $resultado = $usuario->guardar();

                    if($resultado) {
                        header('Location: /mensaje');
                    }

                }
            }
        }


        $router->render('/auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }


    public static function mensaje(Router $router) {


        $router->render('/auth/mensaje', [

        ]);
    }


    public static function confirmar(Router $router) {
        $alertas = [];
        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);  //busca un usuario segun el token
        if(empty($usuario)) {
            //si no encontró usuario:
            Usuario::setAlerta('error', 'El token no es válido.');
        } else {
            //si encontró usuario:
            Usuario::setAlerta('exito', 'Tu cuenta fue confirmada correctamente!');
            $usuario->confirmado = 1;
            $usuario->token= null;
            $usuario->guardar();
        }
        
        $alertas = Usuario::getAlertas();
        $router->render('/auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }
}