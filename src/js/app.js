document.addEventListener("DOMContentLoaded", function () {

    menu();
    modoOscuro();

});
function menu() {
    const menuMovil = document.querySelector('.mobile-menu');

    menuMovil.addEventListener('click', function () {
        const navegacion = document.querySelector('.navegacion');
        navegacion.classList.toggle('mostrar');
    });
}

function modoOscuro() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    console.log(prefiereDarkMode.matches);

    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode')
    }

    prefiereDarkMode.addEventListener('change', function () {
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode')
        }
    });


    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
    });
}