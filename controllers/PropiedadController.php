<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PropiedadController
{
    public static function index(Router $router)
    { // mantenemos la referecia pasando el mismo obj

        $propiedades = Propiedad::all();

        $vendedores = Vendedor::all();

        //mensaje condicional
        $resultado = $_GET['resultado'] ?? null; //si no existe le asigna null

        // Se lo pasamos a la vista
        $router->render('propiedades/admin', [
            // pasamos como arrego asociativo los datos hacia la vista
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }
    public static function crear(Router $router)
    {

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();

        //Arreglo con msj de errores 
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propiedad = new Propiedad($_POST['propiedad']);

            // generar un nombre único de imagen
            $nombreImagen = md5(uniqid((string) rand(), true)) . '.jpg';

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
            // validar
            $errores = $propiedad->validar();


            if (empty($errores)) {

                /** SUBIDA DE ARCHIVOS */

                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                //SUBIR IMAGEN
                //Guardar Imagen con Intervention Image COMPOSER
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);

                $propiedad->guardar();
            }
        }

        // Se lo pasamos a la vista
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar('/admin'); //crear funciones para no sobrecargar el controller

        $propiedad = Propiedad::find($id);

        $errores = Propiedad::getErrores();

        $vendedores = Vendedor::all();

        // POST al actualizar
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los atributos 
            $args = $_POST['propiedad']; // tomo todo lo que se envia

            $propiedad->sincronizar($args);

            // Validacion
            $errores = $propiedad->validar(); //recorre el arreglo y entrega errores

            // generar un nombre único de imagen
            $nombreImagen = md5(uniqid((string) rand(), true)) . '.jpg';

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            if (empty($errores)) {
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    //Almacenar la imagen
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $propiedad->guardar();
            }
        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores,
        ]);
    }

    public static function eliminar() {
         
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
            // validar ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
        
            // accion si el ID es valido
            if ($id) {
        
                $tipo = $_POST['tipo'];
                
                if(validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
        
            }
        }
    }
}
