<?php
session_start();

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

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre     = trim($_POST['nombre'] ?? '');
  $apellidos  = trim($_POST['apellidos'] ?? '');
  $username   = trim($_POST['username'] ?? '');
  $password   = $_POST['password'] ?? '';
  $confirm    = $_POST['confirm'] ?? '';
  $captcha    = isset($_POST['captcha']);

  if (empty($nombre) || empty($apellidos) || empty($username) || empty($password) || empty($confirm)) {
    $error = 'Por favor, completa todos los campos.';
  } elseif ($password !== $confirm) {
    $error = 'Las contraseñas no coinciden.';
  } elseif (strlen($password) < 6) {
    $error = 'La contraseña debe tener al menos 6 caracteres.';
  } elseif (!$captcha) {
    $error = 'Debes confirmar que no eres un robot.';
  } else {
    try {
      $pdo = new PDO($dsn, $user, $pass, $options);

      $stmt = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE username = ?");
      $stmt->execute([$username]);
      if ($stmt->fetch()) {
        $error = 'Este nombre de usuario ya está en uso. Elige otro.';
      } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, apellidos, username, password) 
                            VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $apellidos, $username, $hash]);

        $success = '¡Registro exitoso! Bienvenido, ' . htmlspecialchars($username) . '. Redirigiendo...';

        $_SESSION['usuario'] = $username;
        $_SESSION['id_usuario'] = $pdo->lastInsertId();

        header("Refresh: 2; url=profile.php");
      }
    } catch (PDOException $e) {
      $error = 'Error al conectar con la base de datos. Inténtalo más tarde.';
    }
  }
}
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

  <form method="POST" action="Register.php">
    <h1>Registro</h1>
    <?php if ($error): ?>
      <div style="color: orange;" class="error">⚠️ <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="success">✅ <?= $success ?> Redirigiendo en 2 segundos...</div>
    <?php endif; ?>
    <div class="input-wrapper">
      <i class="fa-regular fa-address-card"></i>
      <input type="text" name="nombre" placeholder="Nombre" required>
    </div>

    <div class="input-wrapper">
      <i class="fa-regular fa-address-card"></i>
      <input type="text" name="apellidos" placeholder="Apellidos" required>
    </div>

    <div class="input-wrapper">
      <i class="fa-solid fa-user"></i>
      <input type="text" name="username" placeholder="Usuario" required>

    </div>
    <div class="input-wrapper">
      <i class="fa-solid fa-lock"></i>
      <input type="password" name="password" placeholder="Contraseña" required>
    </div>
    <div class="input-wrapper">
      <i class="fa-solid fa-lock"></i>
      <input type="password" name="confirm" placeholder="Confirmar contraseña" required>
    </div>
    <div class="captcha-registro">
      <label><input type="checkbox" name="captcha" required> ¿Eres un robot?</label>
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