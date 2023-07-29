<?php 

namespace Controller;

use Model\AdminCita;
use MVC\Router;

class AdminController {
    public static function index (Router $router) {
        if(!isset($_SESSION)) 
        { 
            session_start(); 
            if($_SESSION['admin'] !== "1"){
                header('Location: /cita');
            }
        } 

        isAdmin();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode("-", $fecha);
        if (!checkdate($fechas[1], $fechas[2], $fechas[0])) {
            header('Location: /404');
        }
        

        //consultar multiples tablas, para traer servicios, citas y usuarios:
        $consulta = "SELECT citas.id, citas.hora, CONCAT( usuarios.nombre, ' ', usuarios.apellido) as cliente, ";
        $consulta .= " usuarios.email, usuarios.telefono, servicios.nombre as servicio, servicios.precio  ";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId=usuarios.id  ";
        $consulta .= " LEFT OUTER JOIN citasServicios ";
        $consulta .= " ON citasServicios.citaId=citas.id ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON servicios.id=citasServicios.servicioId ";
        $consulta .= " WHERE fecha =  '{$fecha}' ";

        $citas = AdminCita::SQl($consulta);

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'fecha' => $fecha
        ]);
    }
}