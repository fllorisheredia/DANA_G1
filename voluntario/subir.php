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

// Imagen
$nombreImagen = null;
$carpetaDestino = '../img/';

$categoria = strtolower($_POST['categoria'] ?? ''); // siempre en minúscula

if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    // lógica de subir imagen
} else {
    // imagen por categoría
    switch ($categoria) {
        case 'limpieza':
            $nombreImagen = 'img/servicios.jfif';
            break;
        case 'alimento':
            $nombreImagen = 'img/repartidorcomida.jpg';
            break;
        case 'bricolaje':
            $nombreImagen = 'img/bricolaje.png';
            break;
        case 'transporte':
            $nombreImagen = 'img/coche.webp';
            break;
        default:
            $nombreImagen = 'img/logoSinF.png';
            break;
    }
}

$registroExitoso = false;

// Validaciones
if (empty($nombreProducto) || empty($descripcion) || empty($hora)) {
    header("Location: subir_servicio.php?registro=noExitoso");
    exit;
}

$fecha = DateTime::createFromFormat('Y-m-d\TH:i', $hora);
$fechaActual = new DateTime();

if (!$fecha || $fecha < $fechaActual || strlen($fecha->format('Y')) !== 4) {
    header("Location: subir_servicio.php?registro=noExitoso");
    exit;
}

// Insertar según los campos disponibles
if (!empty($destino) && !empty($origen)) {
    $stmt = $conexion->prepare("INSERT INTO servicios (nombre, descripcion, usuario_ofrece_id, hora_realizar, destino, origen, categoria, imagen) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisssss", $nombreProducto, $descripcion, $usuario_ofrece_id, $hora, $destino, $origen, $categoria, $nombreImagen);
} elseif (!empty($destino)) {
    $stmt = $conexion->prepare("INSERT INTO servicios (nombre, descripcion, usuario_ofrece_id, hora_realizar, destino, categoria, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissss", $nombreProducto, $descripcion, $usuario_ofrece_id, $hora, $destino, $categoria, $nombreImagen);
} else {
    $stmt = $conexion->prepare("INSERT INTO servicios (nombre, descripcion, usuario_ofrece_id, hora_realizar, destino, categoria, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissss", $nombreProducto, $descripcion, $usuario_ofrece_id, $hora, $ciudadAyudar, $categoria, $nombreImagen);
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