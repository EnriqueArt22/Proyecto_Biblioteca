<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit();
}
require "conexion.php";
require "../clases/libros.php";

$consulta = "SELECT * FROM libros";
$resultado = $conexion->query($consulta);
?>

<nav>
    <a href="clientes.php">Clientes</a> |
    <a href="libros.php">Libros</a> |
    <a href="peliculas.php">Películas</a> |
    <a href="reservas.php">Reservas</a> |
    <a href="../logout.php">Cerrar sesión</a>
</nav>

<h1>Listado de Libros</h1>

<?php while ($libro = $resultado->fetch_object(Libro::class)): 
    $check = $conexion->prepare("SELECT * FROM reservas WHERE Id_libro = ?");
    $check->bind_param("i", $libro->Id);
    $check->execute();
    $resultado_check = $check->get_result();
    $reservado = $resultado_check->num_rows > 0;
?>

    <p>
        ID: <?php echo $libro->Id; ?><br>
        Titulo: <?php echo $libro->Titulo; ?><br>
        Id de autor: <?php echo $libro->Autor_id; ?><br>
        Genero: <?php echo $libro->Genero; ?><br>
        Editorial: <?php echo $libro->Editorial; ?><br>
        Paginas: <?php echo $libro->Paginas; ?><br>
        Año: <?php echo $libro->Anio; ?><br>
        Precio: <?php echo $libro->Precio; ?><br>
        Estado: <?php echo $reservado ? "RESERVADO" : "DISPONIBLE"; ?><br>

        <?php if ($reservado == false): ?>
            <form action="procesar_reserva.php" method="POST">
                <input type="hidden" name="id_libro" value="<?php echo $libro->Id; ?>">
                <label>ID Cliente:</label>
                <input type="number" name="id_cliente" required>
                <button type="submit">Reservar</button>
            </form>
        <?php endif; ?>
    </p>
    <hr>
<?php endwhile; ?>