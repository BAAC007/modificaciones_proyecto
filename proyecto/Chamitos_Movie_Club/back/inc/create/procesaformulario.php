<?php
include __DIR__ . "/../db.php";

$nombre         = $_POST['nombre'];
$director       = $_POST['director'];
$fecha_estreno  = $_POST['fecha_estreno'];
$descripcion    = $_POST['descripcion'];
$id_categoria   = $_POST['id_categoria'];

$sql = "
  INSERT INTO peliculas (
    nombre,
    director,
    fecha_estreno,
    descripcion,
    id_categoria
  ) VALUES (
    '$nombre',
    '$director',
    '$fecha_estreno',
    '$descripcion',
    $id_categoria
  )
";

$conexion->query($sql);
$conexion->close();

header("Location: /oscar-bryan-carlos/Chamitos_Movie_Club/back/escritorio.php");
exit;

?>