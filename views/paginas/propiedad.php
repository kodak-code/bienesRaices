<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad->titulo ?></h1>

    <img src="/imagenes/<?php echo $propiedad->imagen ?>" alt="Imagen de la Propiedad" loading="lazy">


    <div class="resumen-propiedad">
        <p class="precio">$<?php echo $propiedad->precio ?></p>

        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" src="./build/img/icono_wc.svg" alt="icono wc" loading="lazy">
                <p><?php echo $propiedad->banio ?></p>
            </li>
            <li>
                <img class="icono" src="./build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy">
                <p><?php echo $propiedad->estacionamiento ?></p>
            </li>
            <li>
                <img class="icono" src="./build/img/icono_dormitorio.svg" alt="icono dormitorio" loading="lazy">
                <p><?php echo $propiedad->habitacion ?></p>
            </li>
        </ul>
        <p><?php echo $propiedad->descripcion ?></p>
    </div>
</main>