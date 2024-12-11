document.addEventListener("DOMContentLoaded", function () {

    eventListeners();

});
function eventListeners() {

    const menuMovil = document.querySelector('.mobile-menu');
    menuMovil.addEventListener('click', navegacionResponcive);

}

function navegacionResponcive() {
    const navegacion = document.querySelector('.navegacion');
    navegacion.classList.toggle('mostrar');
}