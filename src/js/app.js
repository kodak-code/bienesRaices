document.addEventListener("DOMContentLoaded", function () {

    eventListeners();
    //modoOscuro();

});
function eventListeners() {
    const menuMovil = document.querySelector('.mobile-menu');

    menuMovil.addEventListener('click', navegacionResponcive);

    // Muestra campos condicionales telefono/email
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));

}

function navegacionResponcive() {
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');

    if (e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <input name="contacto[telefono]" type="tel" placeholder="Tu telefono" id="telefono">
            
            <p>Elija la fecha y la hora para la llamada</p>

            <label for="fecha">Fecha</label>
            <input name="contacto[fecha]" type="date" id="fecha">

            <label for="hora">Hora:</label>
            <input name="contacto[hora]" type="time" id="hora" min="09:00" max="18:00">
            `;
    } else {
        contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input name="contacto[email]" type="email" placeholder="Tu Email" id="email">
        `;
    }

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