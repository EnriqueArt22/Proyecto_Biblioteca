<?php

session_start(); if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
}

require "conexion.php";
require "../clases/clientes.php";

$consulta = "SELECT * FROM clientes";
$resultado = $conexion->query($consulta);
?>

<nav>
    <a href="clientes.php">Clientes</a> |
    <a href="libros.php">Libros</a> |
    <a href="peliculas.php">Películas</a> |
    <a href="reservas.php">Reservas</a> |
    <a href="../logout.php">Cerrar sesión</a>
</nav>

<?php while ($cliente = $resultado->fetch_object(Cliente::class)): ?>
    <p>
        Id: <?php echo $cliente->ID; ?> 
        <br>
        Nombre: <?php echo $cliente->Nombre; ?>
        <br>
        Apellido: <?php echo $cliente->Apellidos; ?>
        <br>
        Fecha de Nacimiento: <?php echo $cliente->Fecha_nacimiento; ?>
        <br>
        Localidad: <?php echo $cliente->Localidad; ?>
        <br>
    <p>
<?php endwhile; ?>

