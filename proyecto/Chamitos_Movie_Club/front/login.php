<?php
session_start();

// Configuración BD
$host = 'localhost';
$db   = 'proyecto_peliculas';
$user = 'peliculas_app';
$pass = 'Peliculas123$';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = $_POST['password'] ?? '';

  // Depuración: mostrar lo que llega
  $mensaje .= "Usuario recibido: <strong>$username</strong><br>";
  $mensaje .= "Contraseña recibida: " . ($password ? 'Sí (oculta)' : 'No') . "<br>";

  if (empty($username) || empty($password)) {
    $mensaje .= "<span style='color:red;'>Error: Completa ambos campos.</span>";
  } else {
    try {
      $pdo = new PDO($dsn, $user, $pass, $options);

      $stmt = $pdo->prepare("SELECT id_usuario, username, password FROM usuarios WHERE username = ?");
      $stmt->execute([$username]);
      $usuario = $stmt->fetch();

      if ($usuario) {
        $mensaje .= "Usuario encontrado en BD: <strong>{$usuario['username']}</strong><br>";

        if (password_verify($password, $usuario['password'])) {
          // ¡ÉXITO!
          $_SESSION['usuario'] = $usuario['username'];
          $_SESSION['id_usuario'] = $usuario['id_usuario'];

          $mensaje .= "<span style='color:green; font-weight:bold;'>¡Login correcto! Redirigiendo...</span>";

          // Pequeño retraso para que veas el mensaje (solo en pruebas)
          echo $mensaje;
          echo "<br><br>Redirigiendo en 2 segundos...";
          header("Refresh: 2; url=profile.php");
          exit();
        } else {
          $mensaje .= "<span style='color:red;'>Contraseña incorrecta.</span>";
        }
      } else {
        $mensaje .= "<span style='color:red;'>Usuario no encontrado en la base de datos.</span>";
      }
    } catch (Exception $e) {
      $mensaje .= "<span style='color:red;'>Error de conexión: " . $e->getMessage() . "</span>";
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

  <form method="POST" action="login.php" class="login-form">
    <h1>Inicio de Sesión</h1>

    <?php if ($error): ?>
      <div class="alerta error">
        <p>⚠️ <?= htmlspecialchars($error) ?></p>
      </div>
    <?php endif; ?>
    <div class="input-wrapper">
      <i class="fa-solid fa-user"></i>
      <input type="text" name="username" placeholder="Usuario" required>
      value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
    </div>
    <div class="input-wrapper">
      <i class="fa-solid fa-lock"></i>
      <input type="password" name="password" placeholder="Contraseña" required>
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
    <p style="text-align:center; margin-top:30px; color:#888; font-size:0.9em;">
      Chamitos Movie Club © 2025
    </p>
  </footer>

  <?php if ($mensaje): ?>
    <div style="background:#fff3cd; padding:15px; margin:15px 0; border-radius:8px; border:1px solid #ffeaa7;">
      <strong>Depuración:</strong><br>
      <?= $mensaje ?>
    </div>
  <?php endif; ?>

  <p style="margin-top:20px; text-align:center;">
    <strong>Usuarios de prueba:</strong><br>
    oscaradmin, CGallardo, BAvila, jocarsa, lmartinez<br>
    <strong>Contraseña para todos:</strong> password
  </p>

</body>

</html>