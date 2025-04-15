<?php
include 'includes/header.php';
include 'includes/db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = $conexion->prepare("SELECT * FROM usuarios WHERE email = ? AND password = ?");
    $query->bind_param("ss", $email, $password);
    $query->execute();
    $resultado = $query->get_result();


  if ($resultado->num_rows > 0) {
      session_start();
      $_SESSION['usuario'] = $resultado->fetch_assoc();

      // Redirigir según el rol
      switch ($_SESSION['usuario']['rol']) {
          case 'administrador':
              header("Location: admin/indexAdmin.php");
              break;
          case 'cliente':
              header("Location: /DANA0/index.php");
              break;
          case 'voluntario':
              header("Location: voluntario/indexVoluntario.php");
              break;
          default:
              echo "Rol desconocido.";
      }
      exit();
  } else {
      echo "Credenciales incorrectas.";
  }

}


?>

<main>
  <article class="info-box login-box">
    <h2>Iniciar Sesión</h2>
    <form method="POST">
      <label for="email">Correo electrónico:</label>
      <input type="email" id="email" name="email" placeholder="Ingrese su correo electrónico" required>

      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>

      <button type="submit" class="login-btn">Iniciar Sesión</button>
    </form>
  </article>
</main>

<?php
include 'includes/footer.php';
?>