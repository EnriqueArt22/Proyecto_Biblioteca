<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit();
}

require "conexion.php";

$id_libro = $_POST["id_libro"] ?? null;
$id_pelicula = $_POST["id_pelicula"] ?? null;
$fecha = date("Y-m-d");

$consulta = "INSERT INTO reservas (Id_libro, Id_pelicula, Fecha_reserva) VALUES (?, ?, ?)";
$sentencia = $conexion->prepare($consulta);
$sentencia->bind_param("iis", $id_libro, $id_pelicula, $fecha);
$sentencia->execute();

header("Location: reservas.php");
exit();
?>