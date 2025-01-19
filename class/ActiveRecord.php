<?php

namespace App;

class ActiveRecord
{
    //BASE DE DATOS
    protected static $db; // static ya que no va a requerir una nueva instancia
    // Arreglo para poder mapear las columnas de los datos
    protected static $columnasDB = [];
    protected static $tabla = '';

    //Errores
    protected static $errores = [];

    //visibilidad de los atributos
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

    public function guardar()
    {
        if (!is_null($this->id)) {
            // actualizar
            $this->actualizar();
        } else {
            // crear nuevo registro
            $this->crear();
        }
    }
    public function crear()
    {
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        //insert
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos)); // todas las columnas
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos)); // todos los valores
        $query .= " ') ";

        $resultado = self::$db->query($query);

        // Mensaje de exito
        if ($resultado) {
            //redireccionar al index de admin
            header('Location: /admin?resultado=1');
        }
    }

    public function actualizar()
    {
        // Sanitizar los datos, siempre que se interactua con la db se tiene que sanitizar
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE " . static::$tabla ." SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        if ($resultado) {
            //redireccionar al index de admin
            header('Location: /admin?resultado=2');
        }
    }

    public function eliminar()
    {
        //eliminar el registro
        $query = "DELETE FROM " . static::$tabla ." WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }
    }

    //Identificar y unir los atributos de la BD
    public function atributos()
    {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if ($columna === 'id') continue; // ignora el id y continua con el resto de las columnas
            $atributos[$columna] =  $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    //Validacion
    public static function getErrores()
    {
        return self::$errores;
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
            self::$errores[] = 'La imagen es obligatoria';
        }

        return self::$errores;
    }

    // Subida de archivo
    public function setImagen($imagen)
    {
        // Elimina la imagen previa

        if (!is_null($this->id)) {
            $this->borrarImagen();
        }

        // Asignar el atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Elimina el archivo
    public function borrarImagen()
    {
        // Comprobar si existe el archivo que vamos a borrar
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    // Lista todas las propiedades
    public static function all()
    {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Buscar un registro por su ID
    public static function find($id)
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);
    }

    public static function consultarSQL($query)
    {
        //Consultar en la bd
        $resultado = self::$db->query($query);

        //iterar en los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearOBJ($registro);
        }

        //Liberar la memoria 
        $resultado->free();

        //Retornar los resultados
        return $array;
    }

    protected static function crearOBJ($registro)
    {
        $objeto = new static; // se crea un obj de la clase que se esta heredando

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
