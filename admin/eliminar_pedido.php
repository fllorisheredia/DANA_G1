<?php
include '../includes/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conexion->prepare("DELETE FROM pedidos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "ok";
    // Redirigir a la página de pedidos
    header("Location: pedidosAdmin.php");

} else {
    http_response_code(400);
    echo "ID inválido";
}
?>
