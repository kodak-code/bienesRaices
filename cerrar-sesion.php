<?php
session_start();

//reiniciar el arreglo de la sesion a uno vacio
$_SESSION = [];

header('Location: /');