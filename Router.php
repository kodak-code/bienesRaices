<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }
    public function comprobarRutas()
    {

        session_start();

        $auth = $_SESSION['login'] ?? null; //info de la cuenta actual con session_start, dice true si existe sino null

        //Arreglo de rutas protegidas
        $rutas_protegidas = [
            '/admin',
            '/propiedades/crear',
            '/propiedades/actualizar',
            '/propiedades/eliminar',
            '/vendedores/crear',
            '/vendedores/actualizar',
            '/vendedores/eliminar'
        ];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            // funcion de la ruta actual
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            // solo hay POST
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        //Proteger las rutas
        if (in_array($urlActual, $rutas_protegidas) && !$auth) { // si ponen la ruta admin y no estan logeados
            header('Location: /');
        }

        if ($fn) {
            // La URL existe y hay una funcion asociada
            // llamar una funcion cuando no se sabe el nombre, ya que solo se sabe su url
            call_user_func($fn, $this);
        } else {
            echo "Pagina no encontrada";
        }
    }

    //Muestra una vista
    public function render($view, $datos = [])
    { //mostrar en una vista

        foreach ($datos as $key => $value) {
            $$key = $value; // $$key apunta al valor de $key, para imprimir el valor desde la vista 
            // genera variables con el nombre de las key que pasamos en el arreglo
        }

        ob_start(); //inicia un almacenamiento en memoria

        include __DIR__ . "/views/$view.php"; //almacena el script
        $contenido = ob_get_clean(); //limpiamos la memoria sino consume memoria
        include __DIR__ . "/views/layout.php";
    }
}
