<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../includes/db.php';

// CONSULTA DE PRODUCTOS
$productos = $conexion->query("SELECT id, nombre, descripcion, imagen, precio_tonkens, categoria, stock FROM productos ORDER BY id DESC");

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
    $categoria = $_POST['categoria'];
    $stock = $_POST['stock'];  // Aquí recogemos el stock

    // Asignamos una imagen predeterminada según la categoría
    $imagenPredeterminada = getImagenPorCategoria($categoria);

    // Verificar si se subió una imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagenNombre = $_FILES['imagen']['name'];
        $imagenTmp = $_FILES['imagen']['tmp_name'];

        $rutaDestino = '../img_productos/' . basename($imagenNombre);
        $rutaBD = 'img_productos/' . basename($imagenNombre);

        if (move_uploaded_file($imagenTmp, $rutaDestino)) {
            $imagenPredeterminada = $rutaBD; // Usar la imagen subida si se cargó correctamente
        } else {
            $_SESSION['mensaje_error'] = "❌ Error al subir la imagen";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    // Insertar el producto en la base de datos
    $stmt = $conexion->prepare("INSERT INTO productos (usuario_id, nombre, descripcion, precio_tonkens, imagen, categoria, stock) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issdssi", $usuario_id, $nombre, $descripcion, $precio, $imagenPredeterminada, $categoria, $stock);

    if ($stmt->execute()) {
        $_SESSION['mensaje_exito'] = "✅ Producto añadido correctamente.";
    } else {
        $_SESSION['mensaje_error'] = "❌ Error al guardar en la base de datos: " . $stmt->error;
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Función que asigna la imagen predeterminada según la categoría
function getImagenPorCategoria($categoria) {
    switch ($categoria) {
        case 'limpieza':
            return 'img/img_productos/limpieza.png';
        case 'bricolaje':
            return 'img/img_productos/bricolaje.png';
        case 'transp':
            return 'img/img_productos/trasporte.png';
        case 'alimentos':
            return 'img/img_productos/alimento.png';
        default:
            return 'img/logoSinF.png'; // Imagen por defecto general
    }
}
?>

<!-- Estilos y scripts -->
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">

<main class="p-6 space-y-8 max-w-7xl mx-auto">

    <h2 class="text-4xl font-bold text-center text-primary">Productos Disponibles</h2>

    <!-- Botón para añadir producto -->
    <div class="text-center">
        <button class="btn btn-primary shadow-md hover:scale-105 transition-transform"
            onclick="document.getElementById('modal_producto').showModal()">
            + Añadir Producto
        </button>
    </div>

    <!-- Modal para nuevo producto -->
    <dialog id="modal_producto" class="modal">
        <div class="modal-box max-w-md">
            <h3 class="font-bold text-xl mb-4 text-center">+ Nuevo Producto</h3>
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
                    <label class="label">Categoría del producto</label>
                    <select name="categoria" class="select select-bordered w-full mt-2 text-lg py-3" required>
                        <option value="" disabled selected>Selecciona una categoría</option>
                        <option value="limpieza">Limpieza</option>
                        <option value="bricolaje">Bricolaje</option>
                        <option value="transp">Transporte</option>
                        <option value="alimentos">Alimento</option>
                    </select>
                </div>

                <!-- Nuevo campo de Stock -->
                <div class="form-control">
                    <label class="label">Cantidad en stock</label>
                    <input type="number" name="stock" class="input input-bordered" required min="1" />
                </div>

                <div class="form-control">
                    <label class="label">Imagen del producto</label>
                    <input type="file" name="imagen" class="file-input file-input-bordered w-full" accept="image/*" />
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

    <!-- Mensajes de sesión -->
    <?php if (isset($_SESSION['mensaje_exito'])): ?>
    <div class="alert alert-success"><?= $_SESSION['mensaje_exito'] ?></div>
    <?php unset($_SESSION['mensaje_exito']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['mensaje_error'])): ?>
    <div class="alert alert-error"><?= $_SESSION['mensaje_error'] ?></div>
    <?php unset($_SESSION['mensaje_error']); ?>
    <?php endif; ?>

    <!-- Servicios -->
    <?php if ($servicios->num_rows > 0): ?>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php while ($servicio = $servicios->fetch_assoc()): ?>
        <div
            class="card bg-white shadow-xl hover:shadow-2xl transition-shadow duration-300 border border-gray-200 rounded-xl">
            <figure>
                <img src="../<?= htmlspecialchars($servicio['imagen']) ?>"
                    alt="<?= htmlspecialchars($servicio['nombre']) ?>" class="h-48 w-full object-cover rounded-t-xl">
            </figure>
            <div class="card-body p-4">
                <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($servicio['nombre']) ?></h3>
                <p class="text-sm text-gray-600"><span class="font-semibold">Categoría:</span>
                    <?= htmlspecialchars($servicio['categoria']) ?></p>
                <p class="text-sm text-gray-600"><span class="font-semibold">Fecha/Hora:</span>
                    <?= htmlspecialchars($servicio['hora_realizar']) ?></p>
                <?php if (!empty($servicio['origen']) || !empty($servicio['destino'])): ?>
                <p class="text-sm text-gray-600">
                    <span class="font-semibold">Ubicación:</span>
                    <?= htmlspecialchars($servicio['origen'] ?? '') ?>
                    <?= (!empty($servicio['origen']) && !empty($servicio['destino'])) ? '→' : '' ?>
                    <?= htmlspecialchars($servicio['destino'] ?? '') ?>
                </p>
                <?php endif; ?>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <?php else: ?>
    <div class="alert alert-warning mt-6">🚫 No hay servicios disponibles actualmente.</div>
    <?php endif; ?>

</main>