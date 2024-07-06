<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;
use Model\Comentario;

class APIController {
    public static function index() {
            $servicios = Servicio::all();
            echo json_encode($servicios);
    }

    public static function guardar() {
    // Asegúrate de que el valor de 'realizada' está establecido
    $_POST['realizada'] = $_POST['realizada'] ?? 0;

    // Almacena la Cita y devuelve el ID
    $cita = new Cita($_POST);
    $resultado = $cita->guardar();

    $id = $resultado['id'];

    // Almacena los Servicios con el ID de la Cita
    $idServicios = explode(",", $_POST['servicios']);
    foreach($idServicios as $idServicio) {
        $args = [
            'citaId' => $id,
            'servicioId' => $idServicio
        ];
        $citaServicio = new CitaServicio($args);
        $citaServicio->guardar();
    }

    echo json_encode(['resultado' => $resultado]);
}


    public static function eliminar() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            if(filter_var($id,FILTER_VALIDATE_INT)){
                $cita = Cita::find($id);
            }
            if($cita){
                $cita->eliminar(); 
            }
            
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }

    public static function realizada() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            if (filter_var($id, FILTER_VALIDATE_INT)) {
                // Encontrar la cita por su ID
                $cita = Cita::find($id);
                
                // Marcar la cita como realizada (actualizar el valor en la base de datos)
                if ($cita) {
                    $cita->realizada = 1; // Suponiendo que 1 significa "realizada" en tu base de datos
                    $cita->guardar(); // Guardar los cambios en la base de datos
                }
            }
            
            // Redireccionar a la página anterior (o a donde desees)
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }

    }

    public static function noasistio() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cita = Cita::find($id);
    
            if ($cita) {
                // Marcar la cita como no asistida
                $cita->realizada = 2;
                $cita->guardar();
            }
            
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }   

    }

    public static function obtenerComentarios() {
        $comentarios = Comentario::all();
        $comentarios = Comentario::obtenerCOrdenados();
        echo json_encode($comentarios);
    }
}
