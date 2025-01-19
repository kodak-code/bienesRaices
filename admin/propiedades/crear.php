<?php

declare(strict_types=1);

use Intervention\Image\ImageManager;

error_reporting(E_ALL);
ini_set('display_errors', '1');
require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\Drivers\Gd\Driver;

estaAutenticado();


$db = conectarDB();

$propiedad = new Propiedad;

//consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

//Arreglo con mensaje de errores
$errores = Propiedad::getErrores();

//Ejecuta el codigo luego de que el usuario envio el formulario
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

incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Crear</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>


    <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
        
        <?php include '../../includes/templates/formulario_propiedades.php' ?>

        <input class="boton boton-verde" type="submit" value="Crear Propiedad"></input>
    </form>

</main>

<?php
incluirTemplate('footer');
?>