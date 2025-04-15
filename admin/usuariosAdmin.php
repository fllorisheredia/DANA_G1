<?php
include '../includes/db.php';
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'administrador') {
  // header("Location: ../index.php");
  // exit();
}
$resultado = $conexion->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Lista de Usuarios</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />
</head>

<body class="bg-white text-base-content min-h-screen flex flex-col">

  <div class="container mx-auto px-4 py-10 flex-1">
    <h1 class="text-3xl font-bold text-center mb-8">Lista de <span class="text-purple-600">Usuarios</span></h1>

    <div class="overflow-x-auto bg-base-100 rounded-xl shadow-md">
      <table class="table table-zebra w-full">
        <thead class="bg-base-300 text-base font-semibold text-sm uppercase">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Contraseña</th>
            <th>Rol</th>
            <th>Tonkens</th>
            <th>Insignias</th>
            <th>Perfil</th>
            <th>Valoración</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($usuario = $resultado->fetch_assoc()) { ?>
            <tr>
              <td><?php echo $usuario['id']; ?></td>
              <td><?php echo $usuario['nombre']; ?></td>
              <td><?php echo $usuario['email']; ?></td>
              <td><?php echo $usuario['password']; ?></td>
              <td><?php echo $usuario['rol']; ?></td>
              <td><?php echo $usuario['tonkens']; ?></td>
              <td><?php echo $usuario['insignias']; ?></td>
              <td><?php echo $usuario['perfil_publico']; ?></td>
              <td><?php echo $usuario['valoracion']; ?></td>
              <td>
                <a href="#" onclick="toggleMenu(<?php echo $usuario['id']; ?>); return false;"
                  class="btn btn-sm btn-secondary">
                  Editar
                </a>
              </td>
            </tr>

            <!-- Menú Opciones de susuairio -->
            <tr id="menu-content-<?php echo $usuario['id']; ?>" class="hidden bg-base-100">
              <td colspan="10">
                <div class="p-4 rounded-lg border border-base-300">
                  <h2 class="text-lg font-semibold mb-4">Opciones del Usuario <?php echo $usuario['nombre'] ?></h2>
                  <form action="editar_usuario.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="hidden" name="usuario_id" value="<?php echo $usuario['id']; ?>">


                    <div>
                      <label class="label-text font-semibold">Cambiar Correo</label>

                      <input type="email" id="email_<?php echo $usuario['id']; ?>"
                        value="<?php echo $usuario['email']; ?>" class="input input-bordered w-full" />
                      <a href="#" onclick="actualizarMail(<?php echo $usuario['id']; ?>); return false;"
                        class="btn btn-sm btn-secondary mt-2">Actualizar</a>


                      <!--  -->
                    </div>
                    <div>
                      <label class="label-text font-semibold">Cambiar Contraseña</label>
                      <input type="text" id="password_<?php echo $usuario['id']; ?>" value="Nueva Contraseña..."
                        class="input input-bordered w-full" />
                      <a href="#" onclick="actualizarPassword(<?php echo $usuario['id']; ?>); return false;"
                        class="btn btn-sm btn-secondary mt-2">Actualizar</a>
                    </div>
                    <div>
                      <label class="label-text font-semibold">Tonkens</label>
                      <input type="text" id="tonkens_<?php echo $usuario['id']; ?>" value="Nueva Cantidad..."
                        class="input input-bordered w-full" />
                      <a href="#" onclick="actualizarTonkens(<?php echo $usuario['id']; ?>); return false;"
                        class="btn btn-sm btn-secondary mt-2">Actualizar</a>
                    </div>
                    <div>
                      <label class="label-text font-semibold">Valoracion</label>
                      <input type="text" id="valoracion_<?php echo $usuario['id']; ?>"
                        value="<?php echo $usuario['valoracion']; ?>" class="input input-bordered w-full" />
                      <a href="#" onclick="actualizarValoracion(<?php echo $usuario['id']; ?>); return false;"
                        class="btn btn-sm btn-secondary mt-2">Actualizar</a>

                    </div>
                    <div>
                      <label class="label-text font-semibold">Cambiar Rol</label>
                      <input type="text" id="rol_<?php echo $usuario['id']; ?>" value="Nuevo Rol..."
                        class="input input-bordered w-full" />
                      <a href="#" onclick="actualizarRol(<?php echo $usuario['id']; ?>); return false;"
                        class="btn btn-sm btn-secondary mt-2">Actualizar</a>
                    </div>


                    <div class="col-span-full flex justify-end gap-3 mt-4">
                      <button onclick="eliminarUsuario(<?php echo $usuario['id']; ?>); return false;" type="button"
                        class="btn btn-error">
                        Eliminar Usuario
                      </button>
                      <button type="submit" class="btn btn-error">Eliminar</button>
                    </div>
                  </form>
                </div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <footer>
    <?php include '../includes/footer.php'; ?>
  </footer>


  <script src="funciones.js"></script>

</body>

</html>