<?php

namespace Model;

class Admin extends ActiveRecord
{
    // Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {

        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar()
    {
        if (!$this->email) { //si esta vacio
            self::$errores[] = 'El email es obligatorio';
        }
        if (!$this->password) {
            self::$errores[] = 'El password es obligatorio';
        }
        return self::$errores;
    }

    public function existeUsuario()
    {
        //Revisar si el usuario existe o no
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$errores[] = 'El usuario no existe';
            return; // deja de ejecutar el codigo
        }
        return $resultado;
    }

    public function comprobarPassword($resultado)
    {
        $usuario = $resultado->fetch_object(); // resultado de lo que encontro en la db

        //toma el password a comparar y el real, devuelve bool
        $autenticado = password_verify($this->password, $usuario->password);

        if (!$autenticado) {
            self::$errores[] = 'El Password es Incorrecto';
        }
        return $autenticado;
    }

    public function autenticar() {
        session_start();

        //llenar el arreglo de sesion
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}
