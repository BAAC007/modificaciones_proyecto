<!-- IMPORTANTE: Este es el index de admin

/**
 * Backend – Admin entry point
 * Este archivo actúa como puerta de entrada al backend de administración.
 * Comprueba si el usuario ha iniciado sesión como administrador.
 * - Si NO está autenticado: redirige a la página de login de admin.
 * - Si SÍ está autenticado: redirige al escritorio (dashboard).
 * No contiene HTML ni lógica de negocio.
 */
 
-->

<?php
session_start();

/* Når login-formen sendes */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['usuario'] = $_POST['usuario'] ?? 'admin';
    header("Location: escritorio.php");
    exit;
}
?>




<!doctype html>
<html lang="es">
	<head>
  	<title>Chamitos Movie Club</title>
    <meta charset="utf-8">
    <style>
    	body,html{width:100%;height:100%;padding:0px;margin:0px;background:teal;}
      body{display:flex;justify-content:center;align-items:center;}
      form{
      	display:flex;flex-direction:column;gap:20px;
      	padding:40px;background:white;justify-content:center;
        align-items:center;width:150px;height:150px;
      }
      form input{width:100%;padding:10px;box-sizing:border-box;}
    </style>
  </head>
  <body>
  <form method="POST">
    	<input type="text" name="usuario" placeholder="usuario">
      <input type="password" name="contrasena" placeholder="contraseña">
      <input type="submit">
    </form>
  </body>
</html>