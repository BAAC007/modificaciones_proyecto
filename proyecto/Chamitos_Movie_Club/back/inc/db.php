<?php
/**
 * Conexión a la base de datos (Database connection)
 * Archivo común para reutilizar la conexión en el frontend.
 */

$host = "localhost";
$user = "peliculas_app";
$pass = "Peliculas123$";
$db   = "proyecto_peliculas";

$conexion = new mysqli($host, $user, $pass, $db);
if ($conexion->connect_error) {
    die("Connection failed");
}