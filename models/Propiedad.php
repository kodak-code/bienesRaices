<?php

namespace Model;

class Propiedad extends ActiveRecord{
    protected static $tabla = 'propiedades';
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitacion', 'banio', 'estacionamiento', 'creado', 'vendedorId'];

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

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitacion = $args['habitacion'] ?? '';
        $this->banio = $args['banio'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function validar()
    {
        //validar
        if (!$this->titulo) {
            self::$errores[] = 'Debe agregar un titulo';
        }
        if (!$this->precio) {
            self::$errores[] = 'Debe agregar un precio';
        }
        if (strlen($this->descripcion) < 50) {
            self::$errores[] = 'Debe agregar una descripcion';
        }
        if (!$this->habitacion) {
            self::$errores[] = 'Debe agregar un numero de  habitaciones';
        }
        if (!$this->banio) {
            self::$errores[] = 'Debe agregar una cantidad de baños';
        }
        if (!$this->estacionamiento) {
            self::$errores[] = 'Debe agregar una cantidad de estacionamientos';
        }
        if (!$this->vendedorId) {
            self::$errores[] = 'Debe elegir un vendedor';
        }

        if (!$this->imagen) {
            self::$errores[] = 'La imagen de la Propiedad es obligatoria';
        }

        return self::$errores;
    }
}
