<?php

namespace Controller;

use Model\Servicio;
use MVC\Router;

class ServicioController {

    public static function index (Router $router) {
        if(!isset($_SESSION)) {
            session_start();
        }

        isAdmin();

        $servicios = Servicio::all();
        
        $nombre = $_SESSION['nombre'];
        $router->render('/servicios/index', [
            'nombre' => $nombre,
            'servicios' => $servicios
        ]);
   }



   public static function crear (Router $router) {
        if(!isset($_SESSION)) {
            session_start();
        }

        isAdmin();

        $servicio = new Servicio;
        $alertas = [];
    
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            
            $alertas = $servicio->validar();

            if(empty($alertas)) {
                $servicio->guardar();
                header('Location: /servicios');
            }

        }

        $nombre = $_SESSION['nombre'];

        $router->render('/servicios/crear', [
            'nombre' => $nombre,
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }




    public static function actualizar (Router $router) {
        if(!isset($_SESSION)) {
            session_start();
        }

        isAdmin();
    
        if(!is_numeric($_GET['id'])) {
                return;
        }
        $servicio = Servicio::find($_GET['id']);
        $alertas = [];


        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if(empty($alertas)) {
                $servicio->guardar();
                header('Location: /servicios');
            }
            
        }

        $nombre = $_SESSION['nombre'];

        $router->render('/servicios/actualizar', [
            'nombre' => $nombre,
            'alertas' => $alertas,
            'servicio' => $servicio
        ]);
    }

    

    public static function eliminar () {
        if(!isset($_SESSION)) {
            session_start();
        }

        isAdmin();

        if(!is_numeric($_POST['id'])) {
            return;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $servicio = Servicio::find($_POST['id']);
            $servicio->eliminar();
                header('Location: /servicios');
        }
    }
}