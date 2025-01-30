<?php

namespace Controllers;

use Model\Vendedor;
use MVC\Router;

class VendedorController
{
    public static function crear(Router $router)
    {

        $errores = Vendedor::getErrores();

        $vendedor = new Vendedor;

        // logica crear vendedor
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crear una nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']); // creamos un objeto vendedor

            // Validar que no haya campos vacios
            $errores = $vendedor->validar();

            // No hay errores
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        //llevar a la view
        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }
    public static function actualizar(Router $router)
    {

        $errores = Vendedor::getErrores();

        $id = validarORedireccionar('/admin');

        // obtener datos del vendedor a actualizar
        $vendedor = Vendedor::find($id);

        // logica actualizar vendedor
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Asignar los valores
            $args = $_POST['vendedor'];

            // Sincronizar objeto en memoria con lo que el usuario escribio
            $vendedor->sincronizar($args);

            // Validacion
            $errores = $vendedor->validar();

            // No hay errores
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }
    public static function eliminar(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // validar ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            // accion si el ID es valido
            if ($id) {

                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}
