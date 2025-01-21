<fieldset>
    <legend>Informacion General</legend>

    <label for="titulo">Titulo:</label>
    <input name="propiedad[titulo]" type="text" id="titulo" placeholder="Titulo de tu Propiedad" value="<?php echo s($propiedad->titulo); ?>">

    <label for="precio">Precio:</label>
    <input name="propiedad[precio]" type="number" id="precio" placeholder="Precio de tu Propiedad" value="<?php echo s($propiedad->precio); ?>">

    <label for="imagen">Imagen:</label>
    <input name="propiedad[imagen]" type="file" id="imagen" accept="image/jpeg, image/png">

    <?php if($propiedad->imagen) {?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" class= "imagen-small">
    <?php } ?>
    <label for="descripcion">Descripcion:</label>
    <textarea name="propiedad[descripcion]" id="descripcion"><?php echo s($propiedad->descripcion); ?></textarea>

</fieldset>

<fieldset>
    <legend>Informacion Propiedad</legend>

    <label for="habitacion">Habitaciones:</label>
    <input name="propiedad[habitacion]" type="number" id="habitacion" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->habitacion); ?>">

    <label for="banio">Baños:</label>
    <input name="propiedad[banio]" type="number" id="banio" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->banio); ?>">

    <label for="estacionamiento">Estacionamiento:</label>
    <input name="propiedad[estacionamiento]" type="number" id="estacionamiento" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->estacionamiento); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
    <label for="vendedor">Vendedor</label>
    <select name="propiedad[vendedorId]" id="vendedor">
    <option value="" selected disabled>-- Seleccione un vendedor --</option>
        <?php foreach($vendedores as $vendedor) {?>
            <option 
                <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected' : '' ?>
                value="<?php echo s($vendedor->id); ?>"> 
                <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido);?> </option>
        <?php } ?>
    </select>
    
</fieldset>