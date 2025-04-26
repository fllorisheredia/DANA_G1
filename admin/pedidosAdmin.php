<?php
include '../includes/db.php';

// Obtener todos los pedidos y agrupar por estado
$resultado = $conexion->query("SELECT * FROM pedidos");
$pedidos_por_estado = [];

while ($pedido = $resultado->fetch_assoc()) {
    $pedidos_por_estado[$pedido['estado']][] = $pedido;
}
?>

<!-- Tailwind & DaisyUI -->
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8">Gestión de <span class="text-purple-600">Pedidos</span></h1>

    <?php foreach ($pedidos_por_estado as $estado => $pedidos): ?>
    <h2 class="text-xl font-semibold mb-4 capitalize"><?= ucfirst($estado) ?></h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <?php foreach ($pedidos as $pedido): ?>
        <div class="relative bg-white rounded-lg shadow-md p-4 border border-gray-200">
            <h3 class="font-bold text-lg mb-2 text-violet-900">Pedido #<?= $pedido['id'] ?></h3>
            <p class="text-black"><strong>Usuario:</strong> <?= $pedido['usuario_id'] ?></p>
            <p class="text-black"><strong>Fecha:</strong> <?= $pedido['fecha'] ?></p>
            <p class="text-black"><strong>Total:</strong> <?= $pedido['total_tonkens'] ?> Tonkens</p>

            <div class="mt-4">
                <label class="font-semibold text-black">Estado:</label>
                <select class="select select-bordered w-full mt-2"
                    onchange="cambiarEstado(<?= $pedido['id'] ?>, this.value)">
                    <?php
                    $estados = ['pendiente', 'enviado', 'completado'];
                    foreach ($estados as $e) {
                        $selected = $e === $pedido['estado'] ? 'selected' : '';
                        echo "<option value='$e' $selected>" . ucfirst($e) . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mt-4 flex justify-end">
                <button onclick="eliminarPedido(<?= $pedido['id'] ?>)" class="btn btn-error btn-sm">Eliminar</button>
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

<script src="funciones.js"></script>