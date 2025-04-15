<?php
include '../includes/db.php';

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$id = intval($_POST['id']);
$valoracion = floatval($_POST['valoracion']); // Acepta decimales como 4.5

$sql = "UPDATE usuarios SET valoracion = ? WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("di", $valoracion, $id); // d = double, i = int

if ($stmt->execute()) {
    echo "Valoración actualizada correctamente.";
} else {
    echo "Error al actualizar: " . $stmt->error;
}

$stmt->close();
$conexion->close();
