<?php
include '../includes/db.php';

// Obtener todos los servicios y agrupar por categoría
$resultado = $conexion->query("SELECT * FROM servicios");
$servicios_por_categoria = [];

while ($servicio = $resultado->fetch_assoc()) {
    $categoria = $servicio['categoria'];
    $servicios_por_categoria[$categoria][] = $servicio;
}
?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8">Gestión de <span class="text-purple-600">Servicios</span></h1>

    <?php foreach ($servicios_por_categoria as $categoria => $servicios): ?>
    <h2 class="text-xl font-bold mb-4 capitalize text-violet-700"><?= ucfirst($categoria) ?></h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <?php foreach ($servicios as $servicio): ?>
        <div class="relative bg-white rounded-lg shadow-md p-4 border border-gray-200">
            <h3 class="font-bold text-lg mb-2 text-violet-900">Servicio #<?= $servicio['id'] ?></h3>
            <p class="text-black"><strong>ID del Usuario Ofrecedor:</strong> <?= $servicio['usuario_ofrece_id'] ?></p>
            <p class="text-black"><strong>Fecha:</strong> <?= $servicio['fecha'] ?></p>
            <p class="text-black"><strong>Categoría:</strong> <?= $servicio['categoria'] ?></p>
            <p class="text-black"><strong>Total:</strong> <?= $servicio['descripcion'] ?> Tonkens</p>

            <div class="mt-4">
                <label class="font-semibold text-black">Categoria:</label>
                <select class="select select-bordered w-full mt-2"
                    onchange="cambiarCategoria(<?= $servicio['id'] ?>, this.value)">
                    <?php
                    $categorias = ['bricolaje', 'transporte', 'alimento','limpieza'];
                    foreach ($categorias as $e) {
                        $selected = $e === $servicio['categoria'] ? 'selected' : '';
                        echo "<option value='$e' $selected>" . ucfirst($e) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mt-4 flex justify-end">
            <button onclick="eliminarServicio(<?= $servicio['id'] ?>)" class="btn btn-error btn-sm">Eliminar</button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</div>

<!-- Popup de confirmación -->
<div id="popup" class="fixed hidden inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded shadow-lg text-center">
        <p class="text-green-600 font-semibold">¡Estado actualizado correctamente!</p>
        <button onclick="cerrarPopup()" class="btn btn-sm mt-4">Cerrar</button>
    </div>
</div>

<script src="funcionesGestionServicios.js"></script>
