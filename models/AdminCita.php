<?php

namespace Model;

class AdminCita extends ActiveRecord {
    protected static $tabla = 'citasservicios';
    protected static $columnaDB = ['id', 'hora', 'cliente', 'email', 'telefono', 'servicio', 'precio', 'total', 'realizada', 'estado'];

    public $id;
    public $hora;
    public $cliente;
    public $correo;
    public $telefono;
    public $servicio;
    public $precio;
    public $realizada;
    public $estado;

    public function __construct() 
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->total = $args['total'] ?? null;
        $this->realizada = $args['realizada'] ?? null;
        $this->estado = $args['estado'] ?? null;
    }
}