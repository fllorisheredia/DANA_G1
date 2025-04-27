<?php
include '../includes/db.php';

// Verificar que se esté utilizando el método POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verificar que el ID esté presente y sea válido
    if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
        echo "❌ ID inválido.";
        exit;
    }

    $id = intval($_POST['id']);

    // Preparar la consulta para eliminar el producto
    $stmt = $conexion->prepare("DELETE FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "✅ Producto eliminado correctamente.";
    } else {
        echo "❌ Error al eliminar: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "❌ Método inválido. Usa POST.";
}