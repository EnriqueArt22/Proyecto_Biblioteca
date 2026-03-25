<?php

$servidor = "bbdd";
$usuario = "root";
$pass = "bbddphp";
$bbdd = "Proyecto";

$conexion = new mysqli($servidor, $usuario, $pass, $bbdd);

if ($conexion->connect_error)
    die("Error en la conexion: " . $conexion->connect_error);

?>