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
header("Location:login.php"); 
?>