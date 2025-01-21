<?php

require '../../includes/app.php';

//Para los errores
error_reporting(E_ALL);
ini_set('display_errors', '1');

use App\Vendedor;

estaAutenticado();

$vendedor = new Vendedor;

//Arreglo con mensaje de errores
$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear una nueva instancia
    $vendedor = new Vendedor($_POST['vendedor']); // creamos un objeto vendedor
   
    // Validar que no haya campos vacios
    $errores = $vendedor->validar();

    // No hay errores
    if(empty($errores)) {
        $vendedor->guardar();
    }

}

incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Registrar Vendedor(a)</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>


    <form class="formulario" method="POST" action="/admin/vendedores/crear.php">

        <?php include '../../includes/templates/formulario_vendedores.php' ?>

        <input class="boton boton-verde" type="submit" value="Registrar Vendedor(a)"></input>
    </form>

</main>

<?php
incluirTemplate('footer');
?>