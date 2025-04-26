<?php
include '../includes/db.php';

// Si se envía el formulario por AJAX
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST['producto_id']);
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = floatval($_POST['precio_tonkens']);

    $stmt = $conexion->prepare("UPDATE productos SET nombre = ?, descripcion = ?, precio_tonkens = ? WHERE id = ?");
    $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $id);
    $stmt->execute();

    echo "ok";
    exit;
}

// Mostrar productos
$sql = "SELECT * FROM productos ORDER BY id DESC";
$result = $conexion->query($sql);
?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-center mb-8">Lista de <span class="text-purple-600">Productos</span></h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="relative bg-white rounded-lg shadow-md p-4 border border-gray-200">
            <h3 class="text-lg font-bold text-gray-800"><?= htmlspecialchars($row['nombre']) ?></h3>
            <p class="text-sm text-gray-600 mb-2"><?= htmlspecialchars($row['descripcion']) ?></p>
            <div class="text-sm text-gray-500 flex justify-between">
                <span>🆔 <?= $row['id'] ?></span>
                <span>💰 <?= $row['precio_tonkens'] ?> Tokens</span>
            </div>
            <button onclick="toggleMenu2(<?= $row['id'] ?>)"
                class="btn btn-sm btn-secondary mt-3 w-full">Opciones</button>

            <div id="menu-<?= $row['id'] ?>" class="hidden mt-4 border rounded-lg p-4 bg-gray-50 shadow-inner">
                <form onsubmit="guardarProducto(event, <?= $row['id'] ?>)">
                    <input type="hidden" name="producto_id" value="<?= $row['id'] ?>">

                    <label class="font-semibold">Cambiar Nombre</label>
                    <input type="text" name="nombre" value="<?= $row['nombre'] ?>"
                        class="input input-bordered w-full mb-2" />

                    <label class="font-semibold">Cambiar Descripción</label>
                    <input type="text" name="descripcion" value="<?= $row['descripcion'] ?>"
                        class="input input-bordered w-full mb-2" />

                    <label class="font-semibold">Precio Tokens</label>
                    <input type="number" name="precio_tonkens" value="<?= $row['precio_tonkens'] ?>"
                        class="input input-bordered w-full mb-4" />

                    <div class="flex justify-end gap-2">
                        <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                        <button type="button" onclick="eliminarProducto(<?= $row['id'] ?>)"
                            class="btn btn-error btn-sm">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Popup -->
<div id="popup" class="fixed inset-0 bg-black bg-opacity-30 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg text-center">
        <p class="text-green-600 font-semibold">¡Producto actualizado correctamente!</p>
        <button onclick="cerrarPopup()" class="btn btn-sm mt-4">Cerrar</button>
    </div>
</div>

<script src="funciones.js"></script>