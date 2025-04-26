<?php
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "❌ Método inválido. Usa POST.";
    exit;
}

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    echo "❌ ID inválido.";
    exit;
}

$id = intval($_POST['id']);

$stmt = $conexion->prepare("DELETE FROM productos WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "✅ Producto eliminado correctamente.";
} else {
    echo "❌ Error al eliminar: " . $stmt->error;
}

$stmt->close();
$conexion->close();
