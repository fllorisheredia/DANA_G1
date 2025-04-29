<?php
include '../includes/db.php';

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Validar los datos
$id = intval($_POST['id']);
$nombre = $_POST['nombre'];


$stmt = $conexion->prepare("UPDATE usuarios SET nombre = ? WHERE id = ?");
$stmt->bind_param("si", $nombre, $id); 

if ($stmt->execute()) {
    echo "Nombre actualizado correctamente.";
} else {
    echo "Error al actualizar: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>