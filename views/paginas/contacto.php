<main class="contenedor seccion">
    <h1>Contacto</h1>

    <?php if ($mensaje) { ?>
        <p class='alerta exito'><?php echo $mensaje; ?></p>
    <?php } ?>

    <picture>
        <source srcset="./build/img/destacada3.webp" type="image/webp">
        <source srcset="./build/img/destacada3.jpg" type="image/jpeg">
        <img src="./build/img/destacada3.jpg" alt="Imagen Contacto" loading="lazy">
    </picture>

    <h2>Llene el Formulario de Contacto</h2>

    <form class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Informacion Personal</legend>

            <label for="nombre">Nombre</label>
            <input name="contacto[nombre]" type="text" placeholder="Tu nombre" id="nombre">

            <label for="mensaje">Mensaje:</label>
            <textarea name="contacto[mensaje]" id="mensaje"></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion sobre la propiedad</legend>

            <label for="opciones">Vende o Compra:</label>
            <!-- se pone el mismo name en el option -->
            <select name="contacto[tipo]" id="opciones">
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input name="contacto[precio]" type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto">
        </fieldset>

        <fieldset>
            <legend>Informacion sobre Contacto</legend>

            <p>Como desea ser contactado</p>

            <div class="forma-contacto">
                <!-- se pone el mismo name en el type radio -->
                <label for="contactar-telefono">Telefono</label>
                <input name="contacto[contacto]" type="radio" value="telefono" id="contactar-telefono">

                <label for="email">E-mail</label>
                <input name="contacto[contacto]" type="radio" value="email" id="contactar-email">
            </div>

            <div id="contacto"></div>

        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>