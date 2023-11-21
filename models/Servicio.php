<?php

namespace Model;

class Servicio extends ActiveRecord{ // de activerecord vienen los metodos
    // Base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

    public function validar(){
        if(!$this->nombre){
            self::$alertas['error'][] = ' el nombre del servicio e obligatorio';
        }
        if(!is_numeric($this->precio)){
            self::$alertas['error'][] = ' el precio no es valido';
        }

        return self::$alertas;
    }
}