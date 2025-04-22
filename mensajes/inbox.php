<?php
// session_start();
include '../includes/db.php';
include '../includes/header.php';
verificarSesion();

$id_usuario = $_SESSION['usuario']['id'];
$query = $conexion->prepare("SELECT m.id, u.nombre AS remitente, m.mensaje, m.fecha FROM mensajes m JOIN usuarios u ON m.remitente_id = u.id WHERE m.destinatario_id = ? ORDER BY m.fecha DESC");
$query->bind_param("i", $id_usuario);
$query->execute();
$resultado = $query->get_result();
?>

<div class="max-w-4xl mx-auto mt-10 p-6 bg-base-200 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Bandeja de Entrada</h1>

    <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
            <thead>
                <tr>
                    <th>Remitente</th>
                    <th>Mensaje</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($mensaje = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td class="font-semibold"><?php echo htmlspecialchars($mensaje['remitente']); ?></td>
                        <td><?php echo htmlspecialchars($mensaje['mensaje']); ?></td>
                        <td><?php echo htmlspecialchars($mensaje['fecha']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
