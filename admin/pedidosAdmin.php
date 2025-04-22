<?php
// session_start();
include '../includes/db.php';
// Descomenta esto cuando esté listo para producción
// if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'administrador') {
//     header("Location: ../index.php");
//     exit();
// }

$resultado = $conexion->query("SELECT * FROM pedidos");

// Agrupar pedidos por estado
$pedidos_por_estado = [];

while ($pedido = $resultado->fetch_assoc()) {
    $estado = $pedido['estado'];
    if (!isset($pedidos_por_estado[$estado])) {
        $pedidos_por_estado[$estado] = [];
    }
    $pedidos_por_estado[$estado][] = $pedido;
}

include '../includes/header.php';
?>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-10 text-center">Gestión de Pedidos</h1>

    <?php foreach ($pedidos_por_estado as $estado => $pedidos) {
        // Color según estado
        $color = match ($estado) {
            'completado' => 'bg-success/20 border-success',
            'pendiente' => 'bg-yellow-100 border-yellow-400',
            'enviado' => 'bg-blue-100 border-blue-400',
            'entregado' => 'bg-green-100 border-green-400',
            'cancelado' => 'bg-red-100 border-red-400',
            default => 'bg-base-200 border-base-300',
        };
        ?>
        <div class="mb-10">
            <h2 class="text-2xl font-semibold mb-4 capitalize"><?php echo ucfirst($estado); ?></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($pedidos as $pedido) { ?>
                    <div class="card shadow-xl border <?php echo $color; ?>">
                        <div class="card-body">
                            <h3 class="card-title">Pedido #<?php echo $pedido['id']; ?></h3>
                            <p><strong>Usuario:</strong> <?php echo $pedido['usuario_id']; ?></p>
                            <p><strong>Fecha:</strong> <?php echo $pedido['fecha']; ?></p>
                            <p><strong>Total:</strong> <?php echo $pedido['total_tonkens']; ?> Tonkens</p>
                            <div class="card shadow-xl border <?php echo $color; ?>" id="pedido-card-<?php echo $pedido['id']; ?>">
                            <span class="badge badge-outline"><?php echo ucfirst($pedido['estado']); ?></span>
                                <button onclick="toggleMenu(<?php echo $pedido['id']; ?>)" class="btn btn-sm btn-secondary">Opciones</button>
                            </div>

                            <!-- Menú editable -->
                            <div id="menu-<?php echo $pedido['id']; ?>" class="hidden mt-4 bg-white p-4 rounded-lg border border-base-300">
                                <form action="editar_pedido.php" method="POST" class="grid grid-cols-1 gap-3 text-sm bg-white">
                                    <input type="hidden" name="pedido_id" value="<?php echo $pedido['id']; ?>">

                                    <div>
                                        <label class="font-semibold ">Usuario ID</label>
                                        <input type="number" name="usuario_id" value="<?php echo $pedido['usuario_id']; ?>" class="input input-bordered w-full text-white " />
                                    </div>

                                    <div>
                                        <label class="font-semibold">Total Tonkens</label>
                                        <input type="number" name="total_tonkens" value="<?php echo $pedido['total_tonkens']; ?>" class="input input-bordered w-full text-white " />
                                    </div>

                                    <div>
                                        <label class="font-semibold ">Estado</label>
                                        <select name="estado" id="estado-<?php echo $pedido['id']; ?>" onchange="actualizarEstado(<?php echo $pedido['id']; ?>)" class="select select-bordered w-full">
                                        <?php
                                            $estados = ['pendiente', 'enviado', 'entregado', 'completado', 'cancelado'];
                                            foreach ($estados as $estado_opcion) {
                                                $selected = $estado_opcion === $pedido['estado'] ? 'selected' : '';
                                                echo "<option value=\"$estado_opcion\" $selected>" . ucfirst($estado_opcion) . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="flex justify-end gap-2 mt-2">
                                        <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                                        <button type="button" onclick="eliminarPedido(<?php echo $pedido['id']; ?>)" class="btn btn-error btn-sm">Eliminar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>


<script src="funciones.js"></script>

<script>
    function toggleMenu(id) {
        const menu = document.getElementById(`menu-${id}`);
        if (menu) {
            menu.classList.toggle('hidden');
        }
    }

    function eliminarPedido(id) {
        if (confirm("¿Estás seguro de que deseas eliminar este pedido?")) {
            window.location.href = `eliminar_pedido.php?id=${id}`;
        }
    }
</script>

<?php include '../includes/footer.php'; ?>
