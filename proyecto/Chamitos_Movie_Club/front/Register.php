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

?>
<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chamitos Movie Club - Registro</title>
  <link rel="stylesheet" href="css/estilo.css">
  <script src="https://kit.fontawesome.com/e3c79bde02.js" crossorigin="anonymous"></script>
</head>

<body>

  <form method="POST" action="../front/profile.php">
    <h1>Registro</h1>
    <div class="input-wrapper">
      <i class="fa-solid fa-user"></i>
      <input type="text" placeholder="Usuario" required>
    </div>
    <div class="input-wrapper">
      <i class="fa-solid fa-envelope"></i>
      <input type="email" placeholder="Email" required>
    </div>
    <div class="input-wrapper">
      <i class="fa-solid fa-lock"></i>
      <input type="password" placeholder="Contraseña" required>
    </div>
    <div class="captcha-registro">
        <label for="">¿Eres un robot?</label>
        <input type="checkbox" name="" id="" required>
    </div>
    <div class="buttons">
      <button type="submit">Registrarse</button>
      <button type="button" id="btnLogin">Iniciar sesion</button>
      <script>
        document.getElementById('btnLogin').addEventListener('click', function() {
          window.location.href = 'http://localhost/MI_AREA/proyecto/Chamitos_Movie_Club/front/login.php'; 
        });
      </script>
    </div>
  </form>

  <footer>
  </footer>

</body>

</html>