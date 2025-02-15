<?php

namespace Model;

class ActiveRecord
{
    //BASE DE DATOS
    protected static $db; // static ya que no va a requerir una nueva instancia
    // Arreglo para poder mapear las columnas de los datos
    protected static $columnasDB = [];
    protected static $tabla = '';

    //Errores
    protected static $errores = [];




    //Definir la conexion a la BD
    public static function setDB($database)
    {
        // self hace referencia a los atributos estaticos de una misma clase 
        self::$db = $database;
    }

    public function guardar()
    {
        if (!is_null($this->id)) {
            // actualizar si es que hay un ID previamente
            $this->actualizar();
        } else {
            // crear nuevo registro si no hay ID previo
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
            header('Location: /admin?resultado=1'); // mensaje de exito
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
        foreach (static::$columnasDB as $columna) {
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
        return static::$errores;
    }

    public function validar()
    {
        // Cada vez que validemos limpiamos el arreglo
        static::$errores = [];
        return static::$errores;
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

    //Obtiene determinado numero de registros
    public static function get($cantidad)
    {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
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
            $array[] = static::crearOBJ($registro); // static ya que se debe crear el obj de propiedad o vendedor
        }

        //Liberar la memoria con obj
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
