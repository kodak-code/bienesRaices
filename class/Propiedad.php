<?php
namespace App;

class Propiedad {
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitacion;
    public $banio;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitacion = $args['habitacion'] ?? '';
        $this->banio = $args['banio'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = $args['creado'] ?? '';
        $this->vendedorId = $args['vendedorId'] ?? '';
    }
}