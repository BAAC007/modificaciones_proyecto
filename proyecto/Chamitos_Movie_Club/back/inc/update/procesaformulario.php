<?php
include __DIR__ . "/../db.php";

/* Datos del formulario */
$id_pelicula   = $_POST['id_pelicula'];
$nombre        = $_POST['nombre'];
$director      = $_POST['director'];
$fecha_estreno = $_POST['fecha_estreno'];
$descripcion   = $_POST['descripcion'];
$id_categoria  = $_POST['id_categoria'];

/* UPDATE (no INSERT) */
$sql = "
  UPDATE peliculas SET
    nombre = '$nombre',
    director = '$director',
    fecha_estreno = '$fecha_estreno',
    descripcion = '$descripcion',
    id_categoria = $id_categoria
  WHERE id_pelicula = $id_pelicula
";

$conexion->query($sql);
$conexion->close();

header("Location: /oscar-bryan-carlos/Chamitos_Movie_Club/back/escritorio.php");
exit;

?>