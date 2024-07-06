<?php

namespace Model;

class Usuario extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'correo', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $correo;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
        
    }

    //Mensajes de validación para la creación de una cuenta
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if(!$this->apellido){
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }
        if(!$this->correo){
            self::$alertas['error'][] = 'El Correo es Obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'La Contraseña es Obligatoria';
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'La Contraseña debe tener al menos 6 caracteres';
        }
        return self::$alertas;
    }

    public function validarLogin() {
        if(!$this->correo) {
            self::$alertas['error'][] = 'El correo es Obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'La Contraseña es Obligatoria';
        }

        return self::$alertas;
    }

    public function validarEmail() {
        if(!$this->correo) {
            self::$alertas['error'][] = 'El correo es Obligatorio';
        }
        return self::$alertas;
    }

    public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = 'La Contraseña es Obligatoria';
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'La Contraseña debe de tener al menos 6 carácteres';
        }
        return self::$alertas;
    }

    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE correo = '" . $this->correo. "' LIMIT 1";

        $resultado = self::$db->query($query);

        //Linea a borrar si da error en un futuro(CHATGPT)
        if($resultado->num_rows) {
            self::$alertas['error'][] = 'El usuario ya está registrado';
        }

        return $resultado;  
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken() {
        $this->token = uniqid();
    }

    public function comprobarPasswordAndVerificado($password) {
        $resultado = password_verify($password, $this->password);

        if(!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'Contraseña Incorrecta o tu cuenta no está verificada';
        } else {
            return true;
        }
    }
}