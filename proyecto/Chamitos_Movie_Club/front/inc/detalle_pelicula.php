<?php
/**
 * Detalle de la película (Movie detail logic)
 * Este archivo obtiene y muestra la información de una película concreta.
 * Recibe el identificador de la película mediante el parámetro GET ?id=.
 * Se incluye desde front/movie.php.
 */

 include __DIR__ . "/../../back/inc/db.php";


/* Check that the movie id exists */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<p>Película no válida.</p>";
    exit;
}

$id_pelicula = (int) $_GET['id'];

$sql = "
SELECT
    p.nombre,
    p.director,
    p.duracion_min,
    p.restriccion_edad,
    p.fecha_estreno,
    p.descripcion,
    p.imagen,
    c.nombre_categoria
FROM peliculas p
JOIN categorias c ON p.id_categoria = c.id_categoria
WHERE p.id_pelicula = $id_pelicula
";

$resultado = $conexion->query($sql);

if ($resultado->num_rows !== 1) {
    echo "<p>Película no encontrada.</p>";
    exit;
}

$fila = $resultado->fetch_assoc();

/* Output */
echo "
<article>
    <h3>{$fila['nombre']}</h3>
    <p><strong>Director:</strong> {$fila['director']}</p>
    <p><strong>Category:</strong> {$fila['nombre_categoria']}</p>
    <p><strong>Duration:</strong> {$fila['duracion_min']} min</p>
    <p><strong>Age restriction:</strong> {$fila['restriccion_edad']}+</p>
    <p><strong>Release date:</strong> {$fila['fecha_estreno']}</p>
    <p>{$fila['descripcion']}</p>
</article>
";

$conexion->close();