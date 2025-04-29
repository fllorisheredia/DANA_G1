<?php
ob_start();
session_start();
include '../includes/db.php';

$id = $_SESSION['usuario']['id'];
$query = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$resultado = $query->get_result();
$usuario = $resultado->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $foto_perfil = $usuario['foto_perfil'];

    // Procesar nueva imagen si la sube
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        $directorioDestino = '../img/img_perfil/';
        if (!file_exists($directorioDestino)) {
            mkdir($directorioDestino, 0777, true);
        }
        $nombreArchivo = time() . '_' . basename($_FILES['imagen']['name']);
        $rutaCompleta = $directorioDestino . $nombreArchivo;
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaCompleta)) {
            $foto_perfil = 'img/img_perfil/' . $nombreArchivo;
        }
    }

    // Si cambia contraseña, actualiza
    if (!empty($password)) {
        $query = $conexion->prepare("UPDATE usuarios SET nombre = ?, email = ?, password = ?, foto_perfil = ? WHERE id = ?");
        $query->bind_param("ssssi", $nombre, $email, $password, $foto_perfil, $id);
    } else {
        // No cambia contraseña
        $query = $conexion->prepare("UPDATE usuarios SET nombre = ?, email = ?, foto_perfil = ? WHERE id = ?");
        $query->bind_param("sssi", $nombre, $email, $foto_perfil, $id);
    }

    if ($query->execute()) {
        header("Location: perfil.php");
        exit();
    } else {
        echo "<div class='alert alert-error'>❌ Error al actualizar el perfil.</div>";
    }
}
ob_end_flush();
?>

<link rel="icon" type="image/x-icon" href="/DANA_G1/favicon.ico">

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.0.7/dist/full.css" rel="stylesheet" />

<main class="max-w-3xl mx-auto mt-12 p-8 bg-white rounded-xl shadow-xl">
    <h1 class="text-3xl font-bold text-center text-violet-700 mb-8">Editar Perfil</h1>

    <form method="POST" enctype="multipart/form-data" class="space-y-6">

        <!-- Imagen Actual -->
        <div class="flex justify-center">
            <img src="../<?php echo htmlspecialchars($usuario['foto_perfil']); ?>" alt="Foto Perfil"
                class="w-32 h-32 rounded-full object-cover border-4 border-violet-700 shadow-lg">
        </div>

        <!-- Cambiar Foto -->
        <div class="form-control">
            <label class="label font-semibold text-black">Nueva Imagen de Perfil</label>
            <input type="file" name="imagen" class="file-input file-input-bordered w-full" accept="image/*">
        </div>

        <!-- Nombre -->
        <div class="form-control">
            <label class="label font-semibold text-black">Nombre</label>
            <input type="text" name="nombre" class="input input-bordered w-full text-lg"
                value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
        </div>

        <!-- Email -->
        <div class="form-control">
            <label class="label font-semibold text-black">Correo Electrónico</label>
            <input type="email" name="email" class="input input-bordered w-full text-lg"
                value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
        </div>

        <!-- Cambiar Contraseña -->
        <div class="form-control">
            <label class="label font-semibold text-black">Nueva Contraseña (opcional)</label>
            <input type="password" name="password" class="input input-bordered w-full text-lg"
                placeholder="Dejar vacío si no quieres cambiarla">
        </div>

        <div class="flex justify-end">
            <button
                class="btn bg-violet-700 hover:bg-violet-800 text-white font-semibold px-6 py-2 rounded-lg transform hover:scale-105 transition-transform duration-300">
                Guardar Cambios
            </button>
        </div>


    </form>
</main>

<?php include '../includes/footer.php'; ?>