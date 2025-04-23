<?php
// session_start();
include '../includes/db.php';
include '../includes/header.php';
// verificarSesion();

$usuario_id = $_SESSION['usuario']['id'];
$destinatario_id = $_GET['id'] ?? null;

// Obtener todos los usuarios menos el actual
$usuarios = $conexion->prepare("SELECT id, nombre FROM usuarios WHERE id != ?");
$usuarios->bind_param("i", $usuario_id);
$usuarios->execute();
$resultadoUsuarios = $usuarios->get_result()->fetch_all(MYSQLI_ASSOC);

// Obtener mensajes si hay un destinatario seleccionado
$mensajes = [];
if ($destinatario_id) {
    $query = $conexion->prepare("
        SELECT m.*, u.nombre AS remitente_nombre FROM mensajes m
        JOIN usuarios u ON m.remitente_id = u.id
        WHERE (m.remitente_id = ? AND m.destinatario_id = ?)
        OR (m.remitente_id = ? AND m.destinatario_id = ?)
        ORDER BY m.fecha ASC
    ");
    $query->bind_param("iiii", $usuario_id, $destinatario_id, $destinatario_id, $usuario_id);
    $query->execute();
    $mensajes = $query->get_result()->fetch_all(MYSQLI_ASSOC);
}
?>

<div class="flex h-screen">
    <!-- Panel izquierdo: lista de usuarios -->
    <div class="w-1/4 bg-base-200 border-r p-4 overflow-y-auto">
        <h2 class="text-lg font-bold mb-4">Usuarios</h2>
        <ul class="space-y-2">
            <?php foreach ($resultadoUsuarios as $u): ?>
                <li>
                    <a href="?id=<?= $u['id'] ?>"
                        class="btn btn-ghost w-full justify-start <?= $destinatario_id == $u['id'] ? 'bg-base-300' : '' ?>">
                        <?= htmlspecialchars($u['nombre']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Panel dereccho usuario -->
    <div class="flex flex-col flex-1 bg-base-100 p-4">
        <?php if ($destinatario_id): ?>
            <div class="flex-1 overflow-y-auto space-y-4 mb-4">
                <?php foreach ($mensajes as $m): ?>
                    <div class="chat <?= $m['remitente_id'] == $usuario_id ? 'chat-end' : 'chat-start' ?>">
                        <div class="chat-header text-sm font-bold mb-1"><?= htmlspecialchars($m['remitente_nombre']) ?></div>
                        <div class="chat-bubble"><?= htmlspecialchars($m['mensaje']) ?></div>
                        <div class="text-xs text-gray-400"><?= date("H:i", strtotime($m['fecha'])) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Enviar nuevo mensaje -->
            <form method="POST" action="enviar.php" class="mt-auto">
                <input type="hidden" name="destinatario_id" value="<?= $destinatario_id ?>">

                <div class="form-control w-full mb-2">
                    <label class="label">
                        <span class="label-text">Escribe tu mensaje:</span>
                    </label>
                    <textarea name="mensaje" class="textarea textarea-bordered w-full" placeholder="Escribe algo..."
                        required></textarea>
                </div>

                <button type="submit" class="btn btn-primary w-full">Enviar</button>
            </form>

        <?php else: ?>
            <div class="flex items-center justify-center h-full text-gray-500">
                <p>Selecciona un usuario para chatear</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>