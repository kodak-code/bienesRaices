<main class="contenedor seccion">
    <h1>Contacto</h1>

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
            <input name="contacto[nombre]" type="text" placeholder="Tu nombre" id="nombre" required>

            <label for="email">E-mail</label>
            <input name="contacto[email]" type="email" placeholder="Tu Email" id="email" required>

            <label for="telefono">Telefono</label>
            <input name="contacto[telefono]" type="tel" placeholder="Tu telefono" id="telefono">

            <label for="mensaje">Mensaje:</label>
            <textarea name="contacto[mensaje]" id="mensaje" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Informacion sobre la propiedad</legend>

            <label for="opciones">Vende o Compra:</label>
            <!-- se pone el mismo name en el option -->
            <select name="contacto[tipo]" id="opciones" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input name="contacto[precio]" type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto" required>
        </fieldset>

        <fieldset>
            <legend>Informacion sobre la propiedad</legend>

            <p>Como desea ser contactado</p>

            <div class="forma-contacto">
                <!-- se pone el mismo name en el type radio -->
                <label for="contactar-telefono">Telefono</label>
                <input name="contacto[contacto]" type="radio" value="telefono" id="contactar-telefono" required>

                <label for="email">E-mail</label>
                <input name="contacto[contacto]" type="radio" value="email" id="contactar-email" required>
            </div>

            <p>Si eligio telefono, elija la fecha y la hora</p>

            <label for="fecha">Fecha</label>
            <input name="contacto[fecha]" type="date" id="fecha">

            <label for="hora">Hora:</label>
            <input name="contacto[hora]" type="time" id="hora" min="09:00" max="18:00">
        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>