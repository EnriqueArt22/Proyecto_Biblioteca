<?php

require "conexion.php";
require "../clases/usuario.php";

$consulta = "SELECT * FROM Usuarios";
$resultado = $conexion->query($consulta);
echo "<br>";
$usuario = $resultado->fetch_object(Usuario::class);

echo "ID: " . $usuario->ID . "<br>";
echo "Usuario: " . $usuario->Usuario . "<br>";           
echo "Contraseña: " . $usuario->Contrasena . "<br>";     
echo "Email: " . $usuario->Email . "<br>";               
echo "Fecha_nacimiento: " . $usuario->Fecha_nacimiento . "<br>";

?>