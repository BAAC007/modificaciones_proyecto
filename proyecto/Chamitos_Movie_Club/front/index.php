<?php
/**
 * Catálogo de películas (Movie catalog)
 * Página principal del sitio.
 * Muestra la lista completa de películas disponibles en la base de datos.
 * Acceso público, no requiere inicio de sesión.
 */
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Chamitos Movie Club</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>

<body>

<header>
  <h1>Chamitos Movie Club</h1>
  <h2>Tracker de películas</h2>

  <nav>
    <a href="login.php">Login</a>
  </nav>
</header>


<main>
  <?php include "inc/listar_articulos.php"; ?>
</main>

<footer>
</footer>

</body>
</html>