<?php

namespace Controllers;

use MVC\Router;
use Model\Servicio;
use Model\Comentario;

class ServicioController {
    public static function index(Router $router) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        isAdmin();

        $servicios = Servicio::all();

        $router->render('servicios/index', [
            'nombre' => $_SESSION['nombre'],
            'servicios' => $servicios
        ]);
    }

    public static function crear(Router $router) {
        if (session_status() == PHP_SESSION_NONE) {
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

        $router->render('servicios/crear', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        isAdmin();
        if(!is_numeric($_GET['id'])) return;

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

        $router->render('servicios/actualizar', [
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        isAdmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $servicio = Servicio::find($id);
            $servicio->eliminar();
            header('Location: /servicios');
        }
    }

    public static function estado() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $servicio = Servicio::find($id);
            if ($servicio) {
                // Cambiar el estado del servicio (1 = habilitado, 0 = inhabilitado)
                $servicio->estado = $servicio->estado == 1 ? 0 : 1;
                $servicio->guardar();
                header('Location: /servicios');
            }
        }
    }

    public static function eliminarC() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        isAdmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $comentario = Comentario::find($id);
            $comentario->eliminar();
            header('Location: /servicios/comentarios');
            debuguear($comentario);
        }
    }

    public static function comentarios(Router $router) {
        isAdmin();
        date_default_timezone_set('America/Mexico_City');
        $comentarios = Comentario::all();
        $comentarios = Comentario::obtenerCOrdenados();
        
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
            header('Location: /servicios/comentarios');
        } 
    }
    
    
        // Renderizar la vista de comentarios con los datos necesarios
        $router->render('servicios/comentarios', [
            'alertas' => $alertas,
            'nombre' => $nombre,
            'comentarios' => $comentarios
        ]);
    }
}