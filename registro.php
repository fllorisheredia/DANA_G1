<?php
include 'includes/header.php';
include 'includes/db.php';

$registroExitoso = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $rol = trim($_POST['rol'] ?? 'cliente');

    $consulta = $conexion->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, ?)");
    $consulta->bind_param("ssss", $nombre, $email, $password, $rol);

    if ($consulta->execute()) {
        $registroExitoso = true;
    } else {
        $error = "Error al registrar el usuario: " . $consulta->error;
    }
}
?>

<input type="checkbox" id="registroExitosoModal" class="modal-toggle" <?php if ($registroExitoso) echo 'checked'; ?> />
<div class="modal">
    <div class="modal-box text-center">
        <h2 class="text-2xl font-bold text-green-600 mb-4">¡Registro exitoso!</h2>
        <p class="text-lg">Tu cuenta ha sido creada correctamente.</p>
        <div class="modal-action">
            <a href="login.php" class="btn btn-success">Ir al login</a>
        </div>
    </div>
</div>

<div class="min-h-screen flex items-center justify-center bg-base-100">
    <div class="w-full max-w-sm mx-auto overflow-hidden rounded-lg shadow-md dark:bg-gray-800">
        <div class="px-6 py-4">
            <!-- Logo -->
            <div class="flex justify-center mx-auto">
                <img class="w-auto sm:h-20" src="img/logoSinF.png" alt="Logo">
            </div>

            <h3 class="mt-3 text-3xl font-bold text-center text-gray-600 dark:text-gray-200">Registro</h3>

            <form method="POST" class="space-y-6 mt-4">
                <div>
                    <label for="nombre" class="block text-lg font-medium text-gray-300">Nombre</label>
                    <input type="text" id="nombre" name="nombre" class="input input-bordered w-full text-lg py-3 mt-2"
                        placeholder="Ingrese su nombre" required />
                </div>

                <div>
                    <label for="email" class="block text-lg font-medium text-gray-300">Correo electrónico</label>
                    <input type="email" id="email" name="email" class="input input-bordered w-full text-lg py-3 mt-2"
                        placeholder="Ingrese su correo electrónico" required />
                </div>

                <div>
                    <label for="password" class="block text-lg font-medium text-gray-300">Contraseña</label>
                    <input type="password" id="password" name="password"
                        class="input input-bordered w-full text-lg py-3 mt-2" placeholder="Ingrese su contraseña"
                        required />
                </div>

                <!-- Selector de rol -->
                <div>
                    <label for="rol" class="block text-lg font-medium text-gray-300">Tipo de usuario</label>
                    <select id="rol" name="rol" class="select select-bordered w-full mt-2 text-lg py-3" required>
                        <option value="" disabled selected>Selecciona tu rol</option>
                        <option value="cliente">Cliente</option>
                        <option value="voluntario">Voluntario</option>
                    </select>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <button type="submit" class="btn btn-primary w-full py-3 text-xl">Registrarse</button>
                </div>
            </form>
        </div>

        <div class="flex items-center justify-center py-4 text-center bg-gray-50 dark:bg-gray-700">
            <span class="text-sm text-gray-600 dark:text-gray-200">¿Ya tienes una cuenta? </span>
            <a href="login.php" class="mx-2 text-sm font-bold text-blue-500 dark:text-blue-400 hover:underline">Inicia
                sesión</a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>