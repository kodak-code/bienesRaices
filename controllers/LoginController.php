<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;
use Model\Propiedad;

class LoginController
{
    public static function login(Router $router)
    {

        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST); //crea instancia con lo que haya en post
            $errores = $auth->validar();

            if (empty($errores)) {
                //Verificar si el usuario existe
                $resultado = $auth->existeUsuario();

                if (!$resultado) {
                    // mensajes de errores si el usuario no existe
                    $errores = Admin::getErrores();
                } else {
                    //Verificar el password si existe
                    $autenticado = $auth->comprobarPassword($resultado);

                    if($autenticado) { 
                        //Autenticar al usuario
                        $auth->autenticar();
                        
                    } else {
                        // Password incorrecto
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }
    public static function logout()
    {
        session_start();

        $_SESSION = [];

        header('Location: /');
    }
}
