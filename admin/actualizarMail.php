<?php
include '../includes/db.php';

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$id = intval($_POST['id']);
$email = trim($_POST['email']); // mantenemos como string

// Validar correo básico
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Correo no válido.";
    exit;
}

$stmt = $conexion->prepare("UPDATE usuarios SET email = ? WHERE id = ?");
$stmt->bind_param("si", $email, $id);

if ($stmt->execute()) {
    echo "Correo actualizado correctamente.";
} else {
    echo "Error al actualizar: " . $stmt->error;
}

$stmt->close();
$conexion->close();