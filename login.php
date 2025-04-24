<?php
include 'includes/header.php';
include 'includes/db.php';

$error = ""; // Mensaje de error

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

        switch ($_SESSION['usuario']['rol']) {
            case 'administrador':
                header("Location: admin/indexAdmin.php");
                break;
            case 'cliente':
                header("Location: cliente/solicitar_producto.php");
                break;
            case 'voluntario':
                header("Location: voluntario/subir_producto.php");
                break;
            default:
                $error = "Rol desconocido.";
        }
        exit();
    } else {
        $error = "Credenciales incorrectas.";
    }
}
?>

<div class="min-h-screen flex items-center justify-center bg-base-100">

    <div class="w-full max-w-sm mx-auto overflow-hidden rounded-lg shadow-md dark:bg-gray-800">
        <div class="px-6 py-4">

            <div class="flex justify-center mx-auto">
                <img class="w-auto sm:h-20" src="img/logoSinF.png" alt="Logo">
            </div>

            <h3 class="mt-3 text-3xl font-bold text-center text-gray-600 dark:text-gray-200">Iniciar Sesión</h3>

            <?php if (!empty($error)) : ?>
            <div class="alert alert-error mt-4 mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none">
                    <path stroke-linecap="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span><?= htmlspecialchars($error) ?></span>
            </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6 mt-4">
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

                <div class="flex items-center justify-between mt-4">
                    <button type="submit" class="btn btn-primary w-full py-3 text-xl">Iniciar Sesión</button>
                </div>
            </form>
        </div>

        <div class="flex items-center justify-center py-4 text-center bg-gray-50 dark:bg-gray-600">
            <span class="text-sm text-gray-600 dark:text-gray-200">¿No tienes una cuenta? </span>
            <a href="registro.php"
                class="mx-2 text-sm font-bold text-blue-500 dark:text-blue-400 hover:underline">Regístrate</a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>