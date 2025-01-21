<?php

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

require '../../includes/app.php';
estaAutenticado();

//validar el ID 
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /admin');
}


//obtener los datos de la propiedad
$propiedad = Propiedad::find($id);
$vendedores = Vendedor::all();

//Arreglo con mensaje de errores
$errores = Propiedad::getErrores();

//debugear($propiedad);
//Ejecuta el codigo luego de que el usuario envio el formulario
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

incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>


    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include '../../includes/templates/formulario_propiedades.php' ?>

        <input class="boton boton-verde" type="submit" value="Actualizar Propiedad"></input>
    </form>

</main>

<?php
incluirTemplate('footer');
?>