<?php
include '../includes/db.php';

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$id = intval($_POST['id']);
$password = trim($_POST['password']); // mantenemos como string

// Validar correo básico
if (!filter_var($password )) {
    echo "Correo no válido.";
    exit;
}

$stmt = $conexion->prepare("UPDATE usuarios SET password = ? WHERE id = ?");
$stmt->bind_param("si", $password, $id);

if ($stmt->execute()) {
    echo "Contraseña actualizado correctamente.";
} else {
    echo "Error al actualizar: " . $stmt->error;
}

$stmt->close();
$conexion->close();
