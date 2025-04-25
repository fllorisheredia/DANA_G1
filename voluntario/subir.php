<?php
include '../includes/db.php';
session_start();
// Datos del formulario
$usuario_ofrece_id = $_SESSION['usuario']['id'] ?? null;
$nombreProducto = $_POST['nombreProducto'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$hora = $_POST['hora'] ?? null;
$registroExitoso = false;

// Mostrar todos los datos recibidos
echo "<pre>";
print_r($_POST);
echo "</pre>";

// Validación básica
if (empty($nombreProducto) || empty($descripcion) || empty($hora)) {
    die("❌ Faltan datos obligatorios.");
}

// Preparar consulta
$stmt = $conexion->prepare("INSERT INTO servicios (nombre, descripcion, usuario_ofrece_id, hora_realizar) VALUES (?, ?, ?, ?) ");

$stmt->bind_param("ssis", $nombreProducto, $descripcion, $usuario_ofrece_id, $hora);

if ($stmt->execute()) {
    header("Location: subir_producto.php");
    exit;
} else {
    echo "Error al insertar: " . $stmt->error;
}

$conexion->close();
?>