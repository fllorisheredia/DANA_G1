<?php
include '../includes/db.php';
session_start();

// Datos del formulario
$usuario_ofrece_id = $_SESSION['usuario']['id'] ?? null;
$nombreProducto = $_POST['nombreProducto'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$hora = $_POST['hora'] ?? null;
$destino = $_POST['destino'] ?? null;
$origen = $_POST['origen'] ?? null;
$ciudadAyudar = $_POST['ciudad'] ?? null;
$categoria = $_POST['categoria'] ?? null;
$registroExitoso = false;

// Comprobación de nombreProducto
if (empty($nombreProducto)) {
    header("Location: subir_servicio.php?registro=noExitoso");
    exit;
}

// Comprobación de descripcion
if (empty($descripcion)) {
    header("Location: subir_servicio.php?registro=noExitoso");
    exit;
}

// Comprobación de hora
if (empty($hora)) {
    header("Location: subir_servicio.php?registro=noExitoso");
    exit;
}

// Validar que la fecha no es anterior a la fecha actual
$fecha = DateTime::createFromFormat('Y-m-d\TH:i', $hora);

// Verificar si la fecha es válida
if (!$fecha) {
    header("Location: subir_servicio.php?registro=noExitoso");
    exit;
}

// Comparar la fecha proporcionada con la fecha actual
$fechaActual = new DateTime();
if ($fecha < $fechaActual) {
    header("Location: subir_servicio.php?registro=noExitoso");
    exit;
}

// Comprobar que el año de la fecha tiene solo 4 dígitos
if (strlen($fecha->format('Y')) !== 4) {
    header("Location: subir_servicio.php?registro=noExitoso");
    exit;
}

// Insertar según los campos disponibles
if (!empty($destino) && !empty($origen)) {
    $stmt = $conexion->prepare("INSERT INTO servicios (nombre, descripcion, usuario_ofrece_id, hora_realizar, destino, origen, categoria) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissss", $nombreProducto, $descripcion, $usuario_ofrece_id, $hora, $destino, $origen, $categoria);
} else if (!empty($destino)) {
    $stmt = $conexion->prepare("INSERT INTO servicios (nombre, descripcion, usuario_ofrece_id, hora_realizar, destino, categoria) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $nombreProducto, $descripcion, $usuario_ofrece_id, $hora, $destino, $categoria);
} else {
    $stmt = $conexion->prepare("INSERT INTO servicios (nombre, descripcion, usuario_ofrece_id, hora_realizar, destino, categoria) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $nombreProducto, $descripcion, $usuario_ofrece_id, $hora, $ciudadAyudar, $categoria);
}

if ($stmt->execute()) {
    $registroExitoso = true;
    header("Location: subir_servicio.php?registro=exitoso");
    exit;
} else {
    echo "Error al insertar: " . $stmt->error;
}

$conexion->close();
?>