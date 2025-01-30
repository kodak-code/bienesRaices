<?php

namespace Model;

class Vendedor extends ActiveRecord {
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar() {
        //validar
        if (!$this->nombre) {
            self::$errores[] = 'El nombre es obligatorio';
        }
        if (!$this->apellido) {
            self::$errores[] = 'El apellido es obligatorio';
        }
        if (!$this->telefono) {
            self::$errores[] = 'El telefono es obligatorio';
        }
        //Una expresion regular en una forma de buscar un patron dentro de un texto
        //Podemos buscar una expresion regular para un telefono
        // 0-9 numeros, 10 digitos, obligatoriamente
        if((!preg_match('/[0-9]{10}/', $this->telefono) && $this->telefono) ) {
            self::$errores[] = 'Formato de telefono no valido';
        }
        return Vendedor::$errores;
    }
} 