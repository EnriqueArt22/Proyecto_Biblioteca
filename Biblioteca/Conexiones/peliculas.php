<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
}
require "conexion.php";
require "../clases/peliculas.php";

$consulta = "SELECT * FROM peliculas";
$resultado = $conexion->query($consulta);
?>

<nav>
    <a href="clientes.php">Clientes</a> |
    <a href="libros.php">Libros</a> |
    <a href="peliculas.php">Peliculas</a> |
    <a href="reservas.php">Reservas</a> |
    <a href="../logout.php">Cerrar sesión</a>
</nav>

<h1>Listado de Peliculas</h1>

<?php while ($pelicula = $resultado->fetch_object(Pelicula::class)): 
    $check = $conexion->prepare("SELECT * FROM reservas WHERE Id_pelicula = ?");
    $check->bind_param("i", $pelicula->ID);
    $check->execute();
    $resultado_pelicula = $check->get_result();
    $reservado = $resultado_pelicula->num_rows > 0;
?>

    <p>
        ID: <?php echo $pelicula->ID; ?><br>
        Título: <?php echo $pelicula->Titulo; ?><br>
        Año estreno: <?php echo $pelicula->Anio_estreno; ?><br>
        Director: <?php echo $pelicula->Director; ?><br>
        Actores: <?php echo $pelicula->Actores; ?><br>
        Género: <?php echo $pelicula->Genero; ?><br>
        Tipo: <?php echo $pelicula->Tipo_adaptacion; ?><br>
        Adaptación de libro ID: <?php echo $pelicula->Adaptacion_ID; ?><br>
        Estado: <?php
        if ($reservado) {
            echo "RESERVADO";
        } else {
            echo "DISPONIBLE";
            } ?><br>

        <?php if ($reservado == false): ?>
            <form action="procesar_reserva.php" method="POST">
                <input type="hidden" name="id_pelicula" value="<?php echo $pelicula->ID; ?>">
                <label>ID Cliente:</label>
                <input type="number" name="id_cliente" required>
                <button type="submit">Reservar</button>
            </form>
        <?php endif; ?>
    </p>
    <hr>
<?php endwhile; ?>