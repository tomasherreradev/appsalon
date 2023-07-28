<?php

namespace Controller;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController {


    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }


    public static function guardar() {
        //Almacenar cita y devuelve su id
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        $id = $resultado['id'];


        //Almacena las citas y los servicios
        $idServicios = explode(",", $_POST['servicios']);

        foreach($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        //respuesta a js
        $respuesta = [
            'resultado' => $resultado
        ];
        echo json_encode($respuesta);
    }

    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cita = Cita::find($_POST['id']);
            $cita->eliminar();
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
}