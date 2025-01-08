<?php

namespace App;

class Propiedad
{
    protected static $db; // static ya que no va a requerir una nueva instancia
    
    // Arreglo para poder mapear las columnas de los datos
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitacion', 'banio', 'estacionamiento','creado', 'vendedorId'];

    //Errores
    protected static $errores = [];
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

    //Definir la conexion a la BD
    public static function setDB($database)
    {
        // self hace referencia a los atributos estaticos de una misma clase 
        self::$db = $database;
    }
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitacion = $args['habitacion'] ?? '';
        $this->banio = $args['banio'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? 1;
    }

    public function guardar()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //insert
        $query = "INSERT INTO propiedades ( ";
        $query .= join(', ', array_keys($atributos)); // todas las columnas
        $query .= " ) VALUES (' ";  
        $query .= join("', '", array_values($atributos)); // todos los valores
        $query .= " ') ";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    //Identificar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(self::$columnasDB as $columna) {
            if($columna === 'id') continue; // ignora el id y continua con el resto de las columnas
            $atributos[$columna] =  $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value ) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    //Validacion
    public static function getErrores() {
        return self::$errores;
    }

    public function validar() {
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
        self::$errores[] = 'La imagen es obligatoria';
    }

    return self::$errores;
    }

    public function setImagen($imagen) {
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    // Lista todas las propiedades
    public static function all() {
        $query = "SELECT * FROM propiedades";
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function consultarSQL($query) {
        //Consultar en la bd
        $resultado = self::$db->query($query);

        //iterar en los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearOBJ($registro);
        }
        
        //Liberar la memoria 
        $resultado->free();

        //Retornar los resultados
        return $array;
    }

    protected static function crearOBJ($registro) {
        $objeto = new self; // nuevos obj de la calse actual que es propiedad

        foreach($registro as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

}
