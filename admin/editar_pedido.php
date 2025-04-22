<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['pedido_id']);
    $estado = $_POST['estado'] ?? '';

    if ($id && $estado) {
        $stmt = $conexion->prepare("UPDATE pedidos SET estado = ? WHERE id = ?");
        $stmt->bind_param("si", $estado, $id);
        $stmt->execute();
        echo "ok";
    } else {
        http_response_code(400);
        echo "Error en datos";
    }
}
?>
