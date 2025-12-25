<?php
/**
 * Perfil del usuario - Chamitos Movie Club
 *
 * Página personal del usuario autenticado. Muestra:
 * - Información básica del usuario
 * - Sus reseñas y valoraciones de películas
 * - Estadísticas de actividad en el sitio
 *
 * @author     Tu Nombre <tu@email.com>
 * @version    1.0
 * @since      2025-04-01
 * @requires   Sesión iniciada (login obligatorio)
 */

session_start(); // Inicia o reanuda la sesión del usuario
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Chamitos Movie Club - Mi Perfil</title>
    <meta name="description" content="Perfil personal del usuario en Chamitos Movie Club">
    <link rel="stylesheet" href="css/estilo.css">
    <style>
        body{
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <header>
        <h1>Chamitos Movie Club</h1>
        <nav>
            <!-- Aquí iría el menú de navegación en el futuro -->
            <a href="index.php">Inicio</a> | 
            <a href="logout.php">Cerrar sesión</a>
        </nav>
        <h2>Mi perfil</h2>
    </header>

    <main>
        <?php
        /**
         * CONTROL DE ACCESO
         * Verificamos si el usuario ha iniciado sesión.
         * Si no hay variable de sesión 'usuario', redirigimos al login.
         */
        if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) {
            // El usuario no está autenticado
            echo '<section class="alerta">';
            echo '    <p>⚠️ Debes iniciar sesión para acceder a tu perfil.</p>';
            echo '    <p><a href="login.php" class="btn">Ir al login</a></p>';
            echo '</section>';
        } else {
            // Usuario autenticado → mostramos su información
            $nombreUsuario = htmlspecialchars($_SESSION['usuario']); // Seguridad contra XSS
            
            echo '<section class="perfil">';
            echo '    <h3>Bienvenido, ' . $nombreUsuario . ' 👋</h3>';
            echo '    <p>Este es tu espacio personal en Chamitos Movie Club.</p>';
            
            // Aquí irán en el futuro las reseñas, puntuaciones, etc.
            echo '    <div class="estadisticas">';
            echo '        <h4>Tus reseñas</h4>';
            echo '        <p>Próximamente: listado de todas tus reseñas y valoraciones.</p>';
            echo '    </div>';
            
            echo '</section>';
        }
        ?>
    </main>

    <footer>
        <p style="color: orange;">&copy; <?php echo date('Y'); ?> Chamitos Movie Club. Todos los derechos reservados.</p>
    </footer>
</body>
</html>