<?php
/**
* Cerrar sesion de usuario - Chamitos Movie Club
*
* Página de cerrado de sesion del usuario regreso a login.
*/

/*Esto lo que hace es devolver al usuario al login
en caso de que cierre la sesion.*/
session_start();
session_destroy();
header("Location:login.html"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>loguot</title>
</head>
<body>
    <div class="buttons">
      <button type="submit">Registrarse</button>
      <button type="button" id="btnLogin">Iniciar sesion</button>
      <script>
        document.getElementById('btnLogin').addEventListener('click', function() {
          window.location.href = 'http://localhost/MI_AREA/proyecto/Chamitos_Movie_Club/front/login.php'; 
        });
      </script>
    </div>
</body>
</html>