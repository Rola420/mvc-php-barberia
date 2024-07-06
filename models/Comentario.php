<?php

namespace Model;

class Comentario extends ActiveRecord {
    // Base de datos
    protected static $tabla = 'comentarios';
    protected static $columnasDB = ['id', 'nombre', 'comentario', 'respuesta', 'fecha'];

    public $id;
    public $nombre;
    public $comentario;
    public $respuesta;
    public $fecha;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? ''; 
        $this->comentario = $args['comentario'] ?? '';
        $this->respuesta = $args['respuesta'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
    }

    // Función para obtener los comentarios ordenados por fecha descendente
    public static function obtenerCOrdenados() {
        // Consulta SQL para obtener los comentarios ordenados por fecha descendente
        $query = "SELECT * FROM comentarios ORDER BY id DESC";
        return static::consultarSQL($query);
    }
}