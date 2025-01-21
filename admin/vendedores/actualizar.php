<?php

require '../../includes/app.php';

//Para los errores
error_reporting(E_ALL);
ini_set('display_errors', '1');

use App\Vendedor;
estaAutenticado();
$vendedor = new Vendedor;

// Primero validar que sea un ID valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {
    header('Location: /admin');
}

// Obtener el arreglo del vendedor con su ID
$vendedor = Vendedor::find($id);


//Arreglo con mensaje de errores
$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Asignar los valores
    $args = $_POST['vendedor'];
    
    // Sincronizar objeto en memoria con lo que el usuario escribio
    $vendedor->sincronizar($args);
    
    // Validacion
    $errores = $vendedor->validar();

    // No hay errores
    if(empty($errores)) {
        $vendedor->guardar();
    }
}

incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Actualizar Vendedor(a)</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>


    <form class="formulario" method="POST">

        <?php include '../../includes/templates/formulario_vendedores.php' ?>

        <input class="boton boton-verde" type="submit" value="Guardar Cambios"></input>
    </form>

</main>

<?php
incluirTemplate('footer');
?>