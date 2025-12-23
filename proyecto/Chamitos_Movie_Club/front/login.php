<?php
session_start();

// Configuración de la base de datos
$host = 'localhost';
$db   = 'proyecto_peliculas';
$user = 'peliculas_app';
$pass = 'Peliculas123$';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Por favor, completa ambos campos.';
    } else {
        try {
            $pdo = new PDO($dsn, $user, $pass, $options);

            // Buscamos al usuario por username
            $stmt = $pdo->prepare("SELECT id_usuario, username, password FROM usuarios WHERE username = ?");
            $stmt->execute([$username]);
            $usuario = $stmt->fetch();

            if ($usuario && password_verify($password, $usuario['password'])) {
                // ¡Login correcto!
                $_SESSION['usuario'] = $usuario['username'];
                $_SESSION['id_usuario'] = $usuario['id_usuario'];

                // Redirigir al perfil
                header("Location: profile.php");
                exit();
            } else {
                $error = 'Usuario o contraseña incorrectos.';
            }
        } catch (PDOException $e) {
            $error = 'Error de conexión a la base de datos.';
            // En producción no mostrarías $e->getMessage()
        }
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