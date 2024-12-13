<?php
require '../../includes/config/database.php';
$db = conectarDB();
var_dump($db);

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

//Ejecuta el codigo luego de que el usuario envio el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo = $_POST['titulo'];
$precio = $_POST['precio'];
$descripcion = $_POST['descripcion'];
$habitacion = $_POST['habitacion'];
$banio = $_POST['banio'];
$estacionamiento = $_POST['estacionamiento'];
$vendedorId = $_POST['vendedor'];

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

    // echo '<pre>';
    // var_dump($errores);
    // echo '</pre>';

    if (empty($errores)) {
        //insert
        $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitacion, banio, estacionamiento, vendedores_id )
    VALUES ( '$titulo', '$precio', '$descripcion', '$habitacion', '$banio', '$estacionamiento', '$vendedorId' ) ";

        //echo $query;
        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            echo "Insertado Correctamente";
        }
    }
}

require '../../includes/funciones.php';
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


    <form class="formulario" method="POST">
        <fieldset>
            <legend>Informacion General</legend>

            <label for="titulo">Titulo:</label>
            <input name="titulo" type="text" id="titulo" placeholder="Titulo de tu Propiedad" value="<?php echo $titulo;?>">

            <label for="precio">Precio:</label>
            <input name="precio" type="number" id="precio" placeholder="Precio de tu Propiedad" value="<?php echo $precio;?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripcion:</label>
            <textarea name="descripcion" id="descripcion"><?php echo $descripcion;?></textarea>

        </fieldset>

        <fieldset>
            <legend>Informacion Propiedad</legend>

            <label for="habitacion">Habitaciones:</label>
            <input name="habitacion" type="number" id="habitacion" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitacion;?>">

            <label for="banio">Baños:</label>
            <input name="banio" type="number" id="banio" placeholder="Ej: 3" min="1" max="9" value="<?php echo $banio;?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input name="estacionamiento" type="number" id="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo $estacionamiento;?>">
        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>

            <select name="vendedor">
                <option value="">-Elija un Vendedor-</option>
                <option value="1">Matias</option>
                <option value="2">Mael</option>
            </select>
        </fieldset>

        <input class="boton boton-verde" type="submit" value="Crear Propiedad"></input>
    </form>

</main>

<?php
incluirTemplate('footer');
?>