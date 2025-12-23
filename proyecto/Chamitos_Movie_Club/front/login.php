<?php

/**
 * Inicio de sesión (Login)
 * Página de autenticación de usuarios.
 * Permite a un usuario introducir su nombre de usuario y contraseña.
 * Tras un login correcto, el usuario obtiene acceso a funciones personales.
 * Esta página solo muestra el formulario; la validación se procesa en backend.
 * 
 * http://localhost:8080/oscar-bryan-carlos/Chamitos_Movie_Club/front/login.php
 * 
 */
// Aquí más adelante validaremos contra la base de datos

//Esto arriba es que tenemos que hacer Chamitos 


// Pero de momento te llevo al escritorio. Que no es guay. Escritorio es para admins (nosotros, no usuarios)
/**
 * Inicio de sesión (Login)
 * Página de autenticación de usuarios.
 */

session_start(); // ¡¡MUY IMPORTANTE!! Siempre al principio

// Variable para mensajes de error
$error = '';

// Procesar el formulario cuando se envíe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Recoger datos del formulario
  $usuario = trim($_POST['usuario'] ?? '');
  $contrasena = $_POST['contrasena'] ?? '';

  // ===== VALIDACIÓN TEMPORAL (sin base de datos) =====
  // Más adelante aquí conectarás con la BD
  // Por ahora, aceptamos cualquier usuario no vacío con contraseña "1234" (solo para probar)
  if ($usuario !== '' && $contrasena === '1234') {
    // ¡Login correcto!
    $_SESSION['usuario'] = $usuario; // ← Aquí se crea la sesión

    // Redirigir al perfil
    header("Location: profile.php");
    exit();
  } else {
    $error = 'Usuario o contraseña incorrectos. (Prueba con cualquier usuario y contraseña: 1234)';
  }
}

?>
<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chamitos Movie Club - Login</title>
  <link rel="stylesheet" href="css/estilo.css">
  <script src="https://kit.fontawesome.com/e3c79bde02.js" crossorigin="anonymous"></script>
</head>

<body>

  <form method="POST" action="../front/profile.php">
    <h1>Inicio de Sesion</h1>
    <div class="input-wrapper">
      <i class="fa-solid fa-user"></i>
      <input type="text" placeholder="Usuario" required>
    </div>
    <div class="input-wrapper">
      <i class="fa-solid fa-lock"></i>
      <input type="password" placeholder="Contraseña" required>
    </div>
    <div class="buttons">
      <button type="submit">Iniciar Sesion</button>
      <button type="button" id="btnRegistrarse">Registrarse</button>
      <script>
        document.getElementById('btnRegistrarse').addEventListener('click', function() {
          window.location.href = 'http://localhost/MI_AREA/proyecto/Chamitos_Movie_Club/front/Register.php';
        });
      </script>
    </div>
  </form>

  <footer>
  </footer>

</body>

</html>