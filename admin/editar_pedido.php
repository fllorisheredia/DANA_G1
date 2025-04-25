<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y limpiar entrada
    $id = isset($_POST['pedido_id']) ? intval($_POST['pedido_id']) : 0;
    $estado = isset($_POST['estado']) ? trim($_POST['estado']) : '';

    // Validar datos
    $estados_validos = ['pendiente', 'enviado', 'completado'];

    if ($id > 0 && in_array($estado, $estados_validos)) {
        $stmt = $conexion->prepare("UPDATE pedidos SET estado = ? WHERE id = ?");
        $stmt->bind_param("si", $estado, $id);

        if ($stmt->execute()) {
            echo "ok";
        } else {
            http_response_code(500);
            echo "Error al actualizar el estado.";
        }
    } else {
        http_response_code(400);
        echo "Datos inválidos.";
    }
} else {
    http_response_code(405);
    echo "Método no permitido.";
}
?>