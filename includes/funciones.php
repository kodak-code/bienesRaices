<?php
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');
function incluirTemplate(string $nombre, bool $inicio = false)
{

    include TEMPLATES_URL . "/$nombre" . ".php";
}

function estaAutenticado()
{
    session_start();

    if (!$_SESSION['login']) {
        header('Location: /');
    }
}

function debugear($variable): void
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//Escapar / sanitizar el HTML
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

// Validar tipo de contenido

function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos); //busca un string/valor dentro de un arreglo
}

// Muestra los mensajes
function mostrarNotificacion($codigo)
{
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

function validarORedireccionar(string $url)
{
    //validar el ID 
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: $url");
    }
    return $id;
}
