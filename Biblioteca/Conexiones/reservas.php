<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit();
}
require "conexion.php";
require "../clases/reservas.php";

$consulta = "SELECT reservas.*, libros.Titulo as libro_titulo, peliculas.Titulo as pelicula_titulo
        FROM reservas
        LEFT JOIN libros ON reservas.Id_libro = libros.Id
        LEFT JOIN peliculas ON reservas.Id_pelicula = peliculas.ID
        ORDER BY reservas.Fecha_reserva DESC";
$resultado = $conexion->query($consulta);
?>

<nav>
    <a href="clientes.php">Clientes</a> |
    <a href="libros.php">Libros</a> |
    <a href="peliculas.php">Películas</a> |
    <a href="reservas.php">Reservas</a> |
    <a href="../logout.php">Cerrar sesión</a>
</nav>

<h1>Listado de Reservas</h1>

<?php while ($reserva = $resultado->fetch_object(Reserva::class)): ?>
    <p>
        ID Reserva: <?php echo $reserva->Id; ?><br>
        
        <?php if ($reserva->Id_libro): ?>
            Libro: <?php echo $reserva->libro_titulo; ?><br>
        <?php endif; ?>
        
        <?php if ($reserva->Id_pelicula): ?>
            Película: <?php echo $reserva->pelicula_titulo; ?><br>
        <?php endif; ?>
        
        Fecha: <?php echo $reserva->Fecha_reserva; ?><br>
        
        <a href="devolver.php?id=<?php echo $reserva->Id; ?>">Devolver</a>
    </p>
    <br>
<?php endwhile; ?>