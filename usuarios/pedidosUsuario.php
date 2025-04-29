<?php
// pedidosUsuarios.php
session_start();
include_once '../includes/db.php';

$usuario_id = $_SESSION['usuario']['id'];

$query = "SELECT p.id, p.fecha, p.estado, p.total_tonkens, u.nombre AS nombre_proveedor, 
                 p.usuario_id AS proveedor_id, p.valorado
          FROM pedidos p
          JOIN usuarios u ON p.usuario_id = u.id
          WHERE p.usuario_id = ?";

$stmt = $conexion->prepare($query);
$stmt->bind_param('i', $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$pedidos = $result->fetch_all(MYSQLI_ASSOC);
?>
<link rel="icon" type="image/x-icon" href="/DANA_G1/favicon.ico">

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.2/dist/full.css" rel="stylesheet" type="text/css" />
</head>

<body class=" min-h-screen p-6">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-violet-700">Mis Pedidos</h1>

        <?php if (count($pedidos) > 0): ?>
            <div class="grid gap-6">
                <?php foreach ($pedidos as $pedido): ?>
                    <div class="card bg-white p-6 shadow-xl text-black">
                        <h2 class="text-xl font-semibold mb-2">Pedido #<?php echo htmlspecialchars($pedido['id']); ?></h2>
                        <p class="text-gray-600">Fecha: <?php echo htmlspecialchars($pedido['fecha']); ?></p>
                        <p class="text-gray-600">Estado: <?php echo htmlspecialchars($pedido['estado']); ?></p>
                        <p class="text-gray-600">Total Tonkens: <?php echo htmlspecialchars($pedido['total_tonkens']); ?></p>

                        <?php if ($pedido['valorado'] == 0): ?>
                            <button class="btn btn-primary mt-4"
                                onclick="openPopup(<?php echo $pedido['id']; ?>, <?php echo $pedido['proveedor_id']; ?>)">
                                Valorar Servicio
                            </button>
                        <?php else: ?>
                            <span class="text-sm text-gray-500 mt-4 inline-block">Este producto ya ha sido valorado</span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

            </div>
        <?php else: ?>
            <p class="text-gray-700">No tienes pedidos aún.</p>
        <?php endif; ?>
    </div>

    <!-- Popup de valoración -->
    <dialog id="popupValoracion" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg mb-4">¿Estás contento con el Pedido Solicitado?</h3>
            <form method="POST" action="guardarValoracion.php">
                <input type="hidden" name="pedido_id" id="popup_pedido_id">
                <input type="hidden" name="proveedor_id" id="popup_proveedor_id">
                <div class="flex justify-around">
                    <button type="submit" name="respuesta" value="si" class="btn btn-success">Sí</button>
                    <button type="submit" name="respuesta" value="no" class="btn btn-error">No</button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        function openPopup(pedidoId, proveedorId) {
            document.getElementById('popup_pedido_id').value = pedidoId;
            document.getElementById('popup_proveedor_id').value = proveedorId;
            document.getElementById('popupValoracion').showModal();
        }
    </script>
</body>

</html>