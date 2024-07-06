<?php

namespace Controllers;

use MVC\Router;
use Model\Comentario;
use Model\Usuario;

class CitaController {
    public static function index(Router $router) {

         // Verificar si la sesión no está activa antes de iniciarla
         if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        date_default_timezone_set('America/Mexico_City'); 

        // Ahora puedes acceder a $_SESSION['nombre'] de manera segura
        $nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';

        isAuth();
        
        $router->render('cita/index', [
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id']
        ]);
    }

    public static function comentarios(Router $router) {

        date_default_timezone_set('America/Mexico_City'); 
        
        // Ahora puedes acceder a $_SESSION['nombre'] de manera segura
        $nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
        isAuth();
        // Alertas vacías
        $alertas = [];


        // Verifica si el formulario ha sido enviado
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comentario = $_POST['comentario'] ?? '';
            $nombre = $_POST['nombre'] ?? '';
            $fechaActual = date('Y-m-d');
            

            // Crea una instancia de la clase Comentario
            $nuevoComentario = new Comentario();
            $nuevoComentario->comentario = $comentario;
            $nuevoComentario->nombre = $nombre;
            $nuevoComentario->fecha = $fechaActual;

            // Guarda el comentario en la base de datos
            //Crear el usuario 
            $resultado = $nuevoComentario->guardar();

        if($resultado) {
            header('Location: /comentarios');
        } 
    }
    
    
        // Renderizar la vista de comentarios con los datos necesarios
        $router->render('auth/comentarios', [
            'alertas' => $alertas,
            'nombre' => $nombre
        ]);
    }
}

