<?php

require 'includes/app.php';
$db = conectarDB();

//autenticar el usuario
$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";

    $email = mysqli_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_escape_string($db, $_POST['password']);

    if(!$email) {
        $errores[] = 'El email es obligatorio o no es valido';
    }

    if(!$password) {
        $errores[] = 'El password es obligatorio o no es valido';
    }

    if(empty($errores)) {
        //revisar si el usuario existe
        $query = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = mysqli_query($db, $query);

        if($resultado->num_rows) {
            //revisar si el password es correcto
            $usuario = mysqli_fetch_assoc($resultado);

            $auth = password_verify($password, $usuario['password']);

            if($auth) {
                //el usuario esta autenticado
                session_start();

                //llenar el arreglo de la sesion
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

                header('Location: /admin');

            } else {
                $errores[] = 'El password es incorrecto';
            }
        } else {
            $errores[] = 'El usuario no existe';
        }
    }

}

incluirTemplate('header');
?>
<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>

    <?php foreach($errores as $error):?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario" novalidate>
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input name="email" type="email" placeholder="Tu Email" id="email">

            <label for="password">Password</label>
            <input name="password" type="password" placeholder="Tu password" id="password">

        </fieldset>
        <input type="submit" value="Iniciar Sesion" class="boton-verde">
    </form>

</main>

<?php
incluirTemplate('footer');
?>