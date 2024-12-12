<?php

require 'includes/funciones.php';
incluirTemplate('header');
?>
<main class="contenedor seccion">
    <h1>Conoce Sobre Nosotros</h1>

    <div class="contenido-nosotros">
        <div class="imagen">
            <picture>
                <source srcset="./build/img/nosotros.webp" type="image/webp">
                <source srcset="./build/img/nosotros.jpg" type="image/jpeg">
                <img src="./build/img/nosotros.jpg" alt="Sobre Nosotros" loading="lazy">
            </picture>
        </div>

        <div class="texto-nosotros">
            <blockquote>
                25 años de experiencia
            </blockquote>

            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum explicabo veniam voluptatibus nemo.
                Ea ad, esse, vero expedita maxime nobis repellat aut aliquam inventore veniam consectetur rerum nemo.
                Saepe, suscipit.Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum explicabo veniam voluptatibus nemo.
                Ea ad, esse.</p>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Rerum explicabo veniam voluptatibus nemo.
                Ea ad, esse, vero expedita maxime nobis repellat aut aliquam inventore veniam consectetur rerum nemo.
                Saepe, suscipit.</p>
        </div>
    </div>
</main>

<section class="contenedor seccion">
    <h2>Mas Sobre Nosotros</h2>
    <div class="iconos-nosotros">
        <div class="icono">
            <img src="./build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
            <h3>Seguridad</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur ipsa incidunt
                natus quis quia illo unde fuga et porro quas minima ducimus, atque hic asperiores
                ut dicta ad, sed voluptatum.</p>
        </div>
        <div class="icono">
            <img src="./build/img/icono2.svg" alt="Icono Precio" loading="lazy">
            <h3>Precio</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur ipsa incidunt
                natus quis quia illo unde fuga et porro quas minima ducimus, atque hic asperiores
                ut dicta ad, sed voluptatum.</p>
        </div>
        <div class="icono">
            <img src="./build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
            <h3>Tiempo</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur ipsa incidunt
                natus quis quia illo unde fuga et porro quas minima ducimus, atque hic asperiores
                ut dicta ad, sed voluptatum.</p>
        </div>
    </div>
</section>

<?php
incluirTemplate('footer');
?>