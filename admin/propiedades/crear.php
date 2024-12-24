<?php

require '../../includes/app.php';

use App\Propiedad;

$propiedad = new Propiedad();
debugear($propiedad);

estaAutenticado();


$db = conectarDB();

//consultar para obtener los vendedores
$consulta = "SELECT * FROM vendedores";
$resultado = mysqli_query($db, $consulta);

//Arreglo con mensaje de errores
$errores = [];

// iniciarlas aca para luego en el html dejar el valor con la propiedad value
$titulo = '';
$precio = '';
$descripcion = '';
$habitacion = '';
$banio = '';
$estacionamiento = '';
$vendedorId = '';
$creado = date('Y-m-d');

//Ejecuta el codigo luego de que el usuario envio el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // echo '<pre>';
    // var_dump($_POST);
    // echo '</pre>';

    // echo '<pre>';
    // var_dump($_FILES);
    // echo '</pre>';



    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitacion = mysqli_real_escape_string($db, $_POST['habitacion']);
    $banio = mysqli_real_escape_string($db, $_POST['banio']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);

    //asignar files hacia una variable
    $imagen = $_FILES['imagen'];


    //validar
    if (!$titulo) {
        $errores[] = 'Debe agregar un titulo';
    }
    if (!$precio) {
        $errores[] = 'Debe agregar un precio';
    }
    if (strlen($descripcion) < 50) {
        $errores[] = 'Debe agregar una descripcion';
    }
    if (!$habitacion) {
        $errores[] = 'Debe agregar un numero de  habitaciones';
    }
    if (!$banio) {
        $errores[] = 'Debe agregar una cantidad de baños';
    }
    if (!$estacionamiento) {
        $errores[] = 'Debe agregar una cantidad de estacionamientos';
    }
    if (!$vendedorId) {
        $errores[] = 'Debe elegir un vendedor';
    }

    if(!$imagen['name']) {
        $errores[] = 'La imagen es obligatoria';
    }

    //validar por tamaño (1mb maximo)
    $medida = 1000 * 1000;

    if($imagen['size'] > $medida) {
        $errores[] = 'La imagen es muy pesada';
    }

    


    // echo '<pre>';
    // var_dump($errores);
    // echo '</pre>';

    if (empty($errores)) {

        /** SUBIDA DE ARCHIVOS */

        //crear carpeta
        $carpetaImagenes = '../../imagenes/';

        if(!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        //generar un nombre unico de imagen
        $nombreImagen = md5( uniqid( rand(), true ) ) . '.jpg';

        //subir imagen

        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );

        //insert
        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitacion, banio, estacionamiento, creado, vendedores_id )
    VALUES ( '$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitacion', '$banio', '$estacionamiento', '$creado', '$vendedorId' ) ";

        //echo $query;
        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            //redireccionar al index de admin
            header('Location: /admin?resultado=1');
        }
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
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo:</label>
            <input name="titulo" type="text" id="titulo" placeholder="Titulo de tu Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input name="precio" type="number" id="precio" placeholder="Precio de tu Propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input name="imagen" type="file" id="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripcion:</label>
            <textarea name="descripcion" id="descripcion"><?php echo $descripcion; ?></textarea>

        </fieldset>

        <fieldset>
            <legend>Informacion Propiedad</legend>

            <label for="habitacion">Habitaciones:</label>
            <input name="habitacion" type="number" id="habitacion" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitacion; ?>">

            <label for="banio">Baños:</label>
            <input name="banio" type="number" id="banio" placeholder="Ej: 3" min="1" max="9" value="<?php echo $banio; ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input name="estacionamiento" type="number" id="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor">
                <option value="">-Elija un Vendedor-</option>
                <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
                    <option <?php echo $vendedorId === $row['id'] ? 'selected' : ''; ?> value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] . " " . $row['apellido'] ?></option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input class="boton boton-verde" type="submit" value="Crear Propiedad"></input>
    </form>

</main>

<?php
incluirTemplate('footer');
?>