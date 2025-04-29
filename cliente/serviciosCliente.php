<?php
session_start();
include_once '../includes/db.php';

if (!isset($_SESSION['usuario']['id'])) {
    header('Location: ../login.php');
    exit();
}
$usuario_id = $_SESSION['usuario']['id'];

$query = "
SELECT ss.*, s.nombre, s.descripcion, s.imagen, u.nombre AS nombre_proveedor
FROM servicios_solicitados ss
JOIN servicios s ON ss.servicio_id = s.id
JOIN usuarios u ON ss.usuario_ofrece_id = u.id
WHERE ss.usuario_solicita_id = ?
ORDER BY ss.fecha_solicitud DESC
";

$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
$solicitudes = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Servicios</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.2/dist/full.css" rel="stylesheet" type="text/css" />
</head>
<body class=" min-h-screen p-6">
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold mb-6">Mis Servicios Solicitados</h1>

        <?php if (count($solicitudes) > 0): ?>
            <div class="grid gap-6">
                <?php foreach ($solicitudes as $servicio): ?>
                    <div class="card bg-white p-6 shadow-xl">
                        <h2 class="text-xl font-semibold mb-2">Servicio #<?= htmlspecialchars($servicio['id']) ?></h2>
                        <p class="text-gray-600">Fecha de solicitud: <?= htmlspecialchars($servicio['fecha_solicitud']) ?></p>
                        <p class="text-gray-600">Proveedor: <?= htmlspecialchars($servicio['nombre_proveedor']) ?></p>
                        <p class="text-gray-600">Descripción: <?= htmlspecialchars($servicio['descripcion']) ?></p>

                        <?php if ($servicio['valorado'] == 0): ?>
                            <button class="btn btn-primary mt-4"
                                onclick="openPopup(<?= $servicio['servicio_id'] ?>, <?= $servicio['usuario_ofrece_id'] ?>)">
                                Valorar Servicio
                            </button>
                        <?php else: ?>
                            <span class="text-sm text-gray-500 mt-4 inline-block">✅ Ya valorado</span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-gray-700">No tienes servicios solicitados aún.</p>
        <?php endif; ?>
    </div>

    <!-- Popup de valoración -->
    <dialog id="popupValoracion" class="modal">
        <div class="modal-box text-center">
            <h3 class="font-bold text-lg mb-4">¿Estás contento con el servicio?</h3>
            <form id="valoracionForm">
                <input type="hidden" name="servicio_id" id="popup_servicio_id">
                <input type="hidden" name="proveedor_id" id="popup_proveedor_id">
                <div class="flex justify-around">
                    <button type="button" class="btn btn-success" onclick="enviarValoracion('si')">Sí</button>
                    <button type="button" class="btn btn-error" onclick="enviarValoracion('no')">No</button>
                </div>
            </form>
        </div>
    </dialog>

    <script>
        function openPopup(servicioId, proveedorId) {
            document.getElementById('popup_servicio_id').value = servicioId;
            document.getElementById('popup_proveedor_id').value = proveedorId;
            document.getElementById('popupValoracion').showModal();
        }

        function enviarValoracion(respuesta) {
            const servicioId = document.getElementById('popup_servicio_id').value;
            const proveedorId = document.getElementById('popup_proveedor_id').value;

            const formData = new FormData();
            formData.append('servicio_id', servicioId);
            formData.append('proveedor_id', proveedorId);
            formData.append('respuesta', respuesta);

            fetch('../usuarios/guardarValoracion.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    document.getElementById('popupValoracion').close();
                    setTimeout(() => {
                        alert("✅ ¡Gracias por tu valoración!");
                        location.reload();
                    }, 300);
                } else {
                    alert('❌ Error al guardar la valoración.');
                }
            })
            .catch(error => {
                console.error('Error al enviar la valoración:', error);
                alert('❌ Error de conexión.');
            });
        }
    </script>
</body>
</html>
