<?php
include '../includes/db.php';

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$id = intval($_POST['id']);
$rol = trim($_POST['rol']);

//Array con roles permitido
$rolesPermitidos = ["administrador", "cliente", "voluntario"];

if (!in_array($rol, $rolesPermitidos)) {
    echo "Rol no válido.";
    exit;
}


$stmt = $conexion->prepare("UPDATE usuarios SET rol = ? WHERE id = ?");
$stmt->bind_param("si", $rol, $id);

if ($stmt->execute()) {
    echo "Rol actualizado correctamente.";
} else {
    echo "Error al actualizar: " . $stmt->error;
}

$stmt->close();
$conexion->close();

?>