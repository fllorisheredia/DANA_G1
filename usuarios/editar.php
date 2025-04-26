<?php
session_start();
include '../includes/db.php';
include '../includes/header_cliente.php';

$id = $_SESSION['usuario']['id'];
$query = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$resultado = $query->get_result();
$usuario = $resultado->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    $query = $conexion->prepare("UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?");
    $query->bind_param("ssi", $nombre, $email, $id);
    if ($query->execute()) {
        header("Location: /perfil.php");
        exit();
    } else {
        echo "<div class='alert alert-error'>Error al actualizar el perfil.</div>";
    }
}
?>
<<<<<<< HEAD
<h1>Editar Perfil</h1>
<form method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required>
    <button type="submit">Guardar Cambios</button>
</form>
<?php include '../includes/footer.php'; ?>
=======

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.0.7/dist/full.css" rel="stylesheet" />

<main class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-md space-y-6">
    <h1 class="text-2xl font-bold text-center text-purple-700">Editar Perfil</h1>

    <form method="POST" class="space-y-4">
        <div class="form-control">
            <label class="label font-semibold">Nombre</label>
            <input type="text" name="nombre" class="input input-bordered w-full"
                value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
        </div>

        <div class="form-control">
            <label class="label font-semibold">Correo electrónico</label>
            <input type="email" name="email" class="input input-bordered w-full"
                value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
    </form>
</main>

<?php include '../includes/footer.php'; ?>
>>>>>>> fernando
