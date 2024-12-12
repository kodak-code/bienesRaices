<?php

require 'includes/funciones.php';
incluirTemplate('header');
?>
<main class="contenedor seccion contenido-centrado">
    <h1>Casa en Venta frente al bosque</h1>

    <picture>
        <source srcset="./build/img/destacada.webp" type="image/webp">
        <source srcset="./build/img/destacada.jpg" type="image/jpeg">
        <img src="./build/img/destacada.jpg" alt="Imagen de la Propiedad" loading="lazy">
    </picture>

    <div class="resumen-propiedad">
        <p class="precio">$3,000,000</p>

        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" src="./build/img/icono_wc.svg" alt="icono wc" loading="lazy">
                <p>3</p>
            </li>
            <li>
                <img class="icono" src="./build/img/icono_estacionamiento.svg" alt="icono estacionamiento" loading="lazy">
                <p>3</p>
            </li>
            <li>
                <img class="icono" src="./build/img/icono_dormitorio.svg" alt="icono dormitorio" loading="lazy">
                <p>4</p>
            </li>
        </ul>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum explicabo veniam voluptatibus nemo.
            Ea ad, esse, vero expedita maxime nobis repellat aut aliquam inventore veniam consectetur rerum nemo.
            Saepe, suscipit.Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum explicabo veniam
            voluptatibus nemo.
            Ea ad, esse.</p>
        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum explicabo veniam voluptatibus nemo.
            Ea ad, esse, vero expedita maxime nobis repellat aut aliquam inventore veniam consectetur rerum nemo.
            Saepe, suscipit.</p>
    </div>
</main>

<?php
incluirTemplate('footer');
?>