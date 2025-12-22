<?php
/**
 * Detalle de la película (Movie details)
 * Página que muestra la información completa de una película concreta.
 * Recibe el identificador de la película por URL (?id=).
 * Muestra datos como título, descripción, categoría y otra información relevante.
 * Acceso público, no requiere inicio de sesión.
 */
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Chamitos Movie Club - Movie</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>

<body>

<header>
  <h1>Chamitos Movie Club</h1>
  <h2>Detalle de la película</h2>
</header>

<main>
  <?php
    /**
     * Aquí se cargará la película seleccionada.
     * En el siguiente paso se conectará con la base de datos
     * y se usará el parámetro GET 'id' para mostrar la información.
     */
    include "inc/detalle_pelicula.php";
  ?>
</main>

<footer>
</footer>

</body>
</html>