<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../includes/db.php';

$productos = $conexion->query("SELECT nombre, descripcion, imagen, precio_tonkens FROM productos ORDER BY id DESC");

// AÑADIR PRODUCTO
if (isset($_POST['guardar'])) {
    if (!isset($_SESSION['usuario']['id'])) {
        $_SESSION['mensaje_error'] = "⚠️ No has iniciado sesión. No se puede guardar el producto.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    $usuario_id = $_SESSION['usuario']['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio_tonkens'];

    $imagenNombre = $_FILES['imagen']['name'];
    $imagenTmp = $_FILES['imagen']['tmp_name'];
    
    $rutaDestino = '../img_productos/' . basename($imagenNombre);
    $rutaBD = 'img_productos/' . basename($imagenNombre);

    if (move_uploaded_file($imagenTmp, $rutaDestino)) {
        $stmt = $conexion->prepare("INSERT INTO productos (usuario_id, nombre, descripcion, precio_tonkens, imagen) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issds", $usuario_id, $nombre, $descripcion, $precio, $rutaBD);

        if ($stmt->execute()) {
            $_SESSION['mensaje_exito'] = "✅ Producto añadido correctamente.";
        } else {
            $_SESSION['mensaje_error'] = "❌ Error al guardar en la base de datos: " . $stmt->error;
        }
    } else {
        $_SESSION['mensaje_error'] = "❌ Error al subir la imagen";
    }

    // Redirigir para evitar reenvío de formulario
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

?>

<link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Raleway', sans-serif;
        background-color: #f9fafb;
    }
</style>

<main class="p-6 space-y-8 max-w-7xl mx-auto">

    <h2 class="text-4xl font-bold text-center text-primary">🛍️ Productos Disponibles</h2>

    <!-- Botón que abre el modal -->
    <div class="text-center">
        <button class="btn btn-primary shadow-md hover:scale-105 transition-transform" onclick="document.getElementById('modal_producto').showModal()">
            + Añadir Producto
        </button>
    </div>

    <!-- Modal DaisyUI -->
    <dialog id="modal_producto" class="modal">
        <div class="modal-box max-w-md">
            <h3 class="font-bold text-xl mb-4 text-center">🆕 Nuevo Producto</h3>
            
            <form method="POST" enctype="multipart/form-data" class="space-y-4">
                <div class="form-control">
                    <label class="label">Nombre</label>
                    <input type="text" name="nombre" class="input input-bordered" required />
                </div>

                <div class="form-control">
                    <label class="label">Descripción</label>
                    <textarea name="descripcion" class="textarea textarea-bordered" required></textarea>
                </div>

                <div class="form-control">
                    <label class="label">Precio (tonkens)</label>
                    <input type="number" step="0.01" name="precio_tonkens" class="input input-bordered" required />
                </div>

                <div class="form-control">
                    <label class="label">Imagen del producto</label>
                    <input type="file" name="imagen" class="file-input file-input-bordered w-full" accept="image/*" required />
                </div>

                <div class="modal-action justify-between">
                    <button type="submit" name="guardar" class="btn btn-success">Guardar</button>
                    <form method="dialog">
                        <button class="btn">Cancelar</button>
                    </form>
                </div>
            </form>
        </div>
    </dialog>

    <?php if ($productos->num_rows > 0): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php while ($producto = $productos->fetch_assoc()): ?>
                <div class="card bg-white shadow-xl hover:shadow-2xl transition-shadow duration-300 border border-gray-200 rounded-xl">
                    <figure>
                    <img src="/<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>" class="h-48 w-full object-cover rounded-t-xl">
                    </figure>
                    <div class="card-body p-4">
                        <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($producto['nombre']) ?></h3>
                        <p class="text-sm text-gray-600 line-clamp-3"><?= htmlspecialchars($producto['descripcion']) ?></p>
                        <div class="mt-3 flex items-center justify-between">
                            <span class="text-success font-bold">💰 <?= number_format($producto['precio_tonkens'], 2) ?> Tonkens</span>
                            <button class="btn btn-primary btn-sm">Comprar</button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning mt-6">🚫 No hay productos disponibles actualmente.</div>
    <?php endif; ?>

</main>
