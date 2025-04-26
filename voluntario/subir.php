<?php
include '../includes/db.php';
session_start();
// Datos del formulario
$usuario_ofrece_id = $_SESSION['usuario']['id'] ?? null;
$nombreProducto = $_POST['nombreProducto'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$hora = $_POST['hora'] ?? null;
$destino = $_POST['destino'] ?? null;
$llegada = $_POST['llegada'] ?? null;
$registroExitoso = false;
// Validación básica

if (empty($nombreProducto) || empty($descripcion) || empty($hora)) {
    die("❌ Faltan datos obligatorios.");
}

// Preparar consulta
if (empty($destino)){
$stmt = $conexion->prepare("INSERT INTO servicios (nombre, descripcion, usuario_ofrece_id, hora_realizar) VALUES (?, ?, ?, ?) ");

$stmt->bind_param("ssis", $nombreProducto, $descripcion, $usuario_ofrece_id, $hora);

if ($stmt->execute()) {
    $registroExitoso = true;
    header("Location: subir_producto.php?registro=exitoso");
    exit;
} else {
    echo "Error al insertar: " . $stmt->error;
}
} else{

    $stmt = $conexion->prepare("INSERT INTO servicios (nombre, descripcion, usuario_ofrece_id, hora_realizar, destino, lugar_llegada) VALUES (?, ?, ?, ?, ?, ?) ");
    $stmt->bind_param("ssisss", $nombreProducto, $descripcion, $usuario_ofrece_id, $hora, $destino, $llegada);
    if ($stmt->execute()) {
        $registroExitoso = true;
        header("Location: subir_producto.php?registro=exitoso");
        exit;
    } else {
        echo "Error al insertar: " . $stmt->error;
    }
} 


$conexion->close();
?>