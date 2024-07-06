<?php

namespace Model;

class Cita extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'citas';
    protected static $columnasDB = ['id', 'fecha', 'hora', 'usuarioId', 'total', 'realizada'];

    public $id;
    public $fecha;
    public $hora;
    public $usuarioId;
    public $total;
    public $realizada;

    public function __construct($args = []) {

        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? '';
        $this->total = $args['total'] ?? null;
        $this->realizada = $args['realizada'] ?? null;
    }
}