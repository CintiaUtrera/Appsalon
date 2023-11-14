<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController{
    public static function index(){
        $servicios = Servicio::all();
        echo json_encode($servicios);
        
    }

    public static function guardar(){
        // Almacena la cita y devuelve el id
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado['id'];

        // Almacena los servicios con el ID de la cita
        $idServicios = explode(",", $_POST['servicios']);
        
        foreach($idServicios as $idServicio){
            $args = [
                'citaId' => $id,
                'serviciosId' => $idServicio
            ];

            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        $respuesta = [
            'resultado' => $resultado
        ];

        echo json_encode($respuesta);
    }
}