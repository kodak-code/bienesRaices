<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesion</h1>

    <?php foreach($errores as $error):?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario" action="/login">
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