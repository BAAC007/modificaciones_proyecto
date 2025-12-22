
<!--
Dette er login
http://localhost:8080/1-Programacion/010.-Programacion-del-servidor/009-Implantacion-CRUD/Noticias-tecnologicas.web/admin/

Dette er escritorio
http://localhost:8080/1-Programacion/010.-Programacion-del-servidor/009-Implantacion-CRUD/Noticias-tecnologicas.web/admin/escritorio.php

Dette er når man klikker på knappen
http://localhost:8080/1-Programacion/010.-Programacion-del-servidor/009-Implantacion-CRUD/Noticias-tecnologicas.web/admin/escritorio.php?accion=nuevo

/**
 * Escritorio de administración (Admin dashboard)
 * Página principal del backend para gestión de contenido.
 * Requiere que el usuario haya iniciado sesión como administrador.
 */

-->

 <?php
 session_start();
 
 if (!isset($_SESSION['usuario'])) {
     header("Location: index.php");
     exit;
 }
 ?> 


<!doctype html>
<html lang="es">
	<head>
  	<title>Chamitos Movie Club</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/estilo.css">
  </head>
  <body>
  	<nav>
    	<button>Que quereis aqui?</button>
      <button>Ideeas?</button>
      <button>Mas cosas?</button>
      <button><a href="index.php">Logout from admin</a></button>
      <button><a href="../front/index.php">Ver sitio (Frontend)</a></button>
    </nav>
    <main>
    	<?php
      	// Esto se conoce como router (enrutador) /////////////
      	if(isset($_GET['accion'])){
        	if($_GET['accion'] == "nuevo"){
          	include "inc/create/formulario.php";
          }else if($_GET['accion'] == "eliminar"){ 					// Defino la acción eliminar
          	include "inc/delete/eliminar.php";							// En ese caso incluyo eliminar.php
          }else if($_GET['accion'] == "editar"){ 						// Defino la acción editar
          	include "inc/update/formularioactualizar.php";	// En ese caso incluyo el formulario de la edicion.php
          }
        }else{
      		include "inc/read/leer.php"; 
        }
      ?>
      <a href="?accion=nuevo" id="nuevo">+</a>
    </main>
  </body>
</html>