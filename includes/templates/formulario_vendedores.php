<fieldset>
    <legend>Informacion General</legend>

    <label for="nombre">Nombre:</label>
    <input name="vendedor[nombre]" type="text" id="nombre" placeholder="Nombre del Vendedor(a)" 
    value="<?php echo s($vendedor->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input name="vendedor[apellido]" type="text" id="apellido" placeholder="Apellido del Vendedor(a)" 
    value="<?php echo s($vendedor->apellido); ?>">
</fieldset>

<fieldset>
    <legend>Informacion Extra</legend>

    <label for="telefono">Telefono:</label>
    <input name="vendedor[telefono]" type="tel" id="telefono" placeholder="Telefono del Vendedor(a)" 
    value="<?php echo s($vendedor->telefono); ?>">
</fieldset> 