<?php
include __DIR__ . "/../db.php";

/* Atrapo el id de la película a eliminar */
$id = $_GET['id'];

/* Preparo la petición */
$sql = "DELETE FROM peliculas WHERE id_pelicula = $id";

/* Ejecuto la petición */
$conexion->query($sql);

/* Cierro la conexión */
$conexion->close();

/* Vuelvo al escritorio */
header("Location: /oscar-bryan-carlos/Chamitos_Movie_Club/back/escritorio.php");
exit;

?>