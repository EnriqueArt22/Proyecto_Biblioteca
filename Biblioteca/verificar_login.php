<?php
session_start();

require "Conexiones/conexion.php";
require "clases/usuario.php";

$usuario = $_POST["usuario"];
$contraseña = $_POST["contraseña"];

$consulta = "SELECT * FROM Usuarios WHERE Usuario = ?";
$sentencia = $conexion->prepare($consulta);
$sentencia->bind_param("s", $usuario);
$sentencia->execute();

$resultado = $sentencia->get_result();
$usuario = $resultado->fetch_object(Usuario::class);

if ($usuario != null && hash("sha256", $contraseña) == $usuario->Contrasena) {
    $_SESSION["usuario"] = $usuario->Usuario;
    header("Location: Conexiones/clientes.php");
} else {
    header("Location: login.php");
}
?>