<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo:</label>
    <input name="titulo" type="text" id="titulo" placeholder="Titulo de tu Propiedad" value="<?php echo s($propiedad->titulo); ?>">

    <label for="precio">Precio:</label>
    <input name="precio" type="number" id="precio" placeholder="Precio de tu Propiedad" value="<?php echo s($propiedad->precio); ?>">

    <label for="imagen">Imagen:</label>
    <input name="imagen" type="file" id="imagen" accept="image/jpeg, image/png">

    <label for="descripcion">Descripcion:</label>
    <textarea name="descripcion" id="descripcion"><?php echo s($propiedad->descripcion); ?></textarea>

</fieldset>

<fieldset>
    <legend>Informacion Propiedad</legend>

    <label for="habitacion">Habitaciones:</label>
    <input name="habitacion" type="number" id="habitacion" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->habitacion); ?>">

    <label for="banio">Baños:</label>
    <input name="banio" type="number" id="banio" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->banio); ?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input name="estacionamiento" type="number" id="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->estacionamiento); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    
</fieldset>