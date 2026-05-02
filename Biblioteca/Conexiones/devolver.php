<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
}
require "conexion.php";

$id = $_GET["id"];

$consulta = "DELETE FROM reservas WHERE Id = ?";
$sentencia = $conexion->prepare($consulta);
$sentencia->bind_param("i", $id);
$sentencia->execute();

header("Location: reservas.php");
?>