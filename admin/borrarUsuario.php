<?php
include '../includes/db.php';

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    echo "ID inválido.";
    exit;
}

$id = intval($_POST['id']);

$stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Usuario eliminado correctamente.";
} else {
    echo "Error al eliminar: " . $stmt->error;
}

$stmt->close();
$conexion->close();
