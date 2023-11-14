<?php

namespace Model;

class CitaServicio extends ActiveRecord {
    protected static $tabla = 'citasServicios';
    protected static $columnasDB = ['cita', 'citaId', 'serviciosId'];

    public $id;
    public $citaId;
    public $serviciosId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->citaId = $args['citaId'] ?? null;
        $this->serviciosId = $args['serviciosId'] ?? null;
    }
}