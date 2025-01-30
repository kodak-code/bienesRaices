<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>
    <!-- Errores -->
    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>

    <!-- enctype="multipart/form-data" PARA LAS IMAGENES -->
    <form action="" class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>
        <input class="boton boton-verde" type="submit" value="Actualizar Propiedad"></input>
    </form>

</main>