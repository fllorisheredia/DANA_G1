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

$especialidad = $_POST['especialidad'] ?? null;
$ciudadAyudar = $_POST['ciudad'] ?? null;
$categoria = $_POST['categoria'] ?? null;
$registroExitoso = false;

// Comprobación de nombreProducto
if (empty($nombreProducto)) {
    header("Location: subir_producto.php?registro=noExitoso");
    exit;
}

// Comprobación de descripcion
if (empty($descripcion)) {
    header("Location: subir_producto.php?registro=noExitoso");
    exit;
}

// Comprobación de hora
if (empty($hora)) {
    header("Location: subir_producto.php?registro=noExitoso");
    exit;
}

// Validar que la fecha no es anterior a la fecha actual
$fecha = DateTime::createFromFormat('Y-m-d\TH:i', $hora);

// Verificar si la fecha es válida
if (!$fecha) {
    header("Location: subir_producto.php?registro=noExitoso");
    exit;
}

// Comparar la fecha proporcionada con la fecha actual
$fechaActual = new DateTime();
if ($fecha < $fechaActual) {
    header("Location: subir_producto.php?registro=noExitoso");
    exit;
}

// Comprobar que el año de la fecha tiene solo 4 dígitos
if (strlen($fecha->format('Y')) !== 4) {
    header("Location: subir_producto.php?registro=noExitoso");
    exit;
}
// Preparar consulta para especialidad y destino
if (!empty($especialidad)) {
    // Si hay especialidad, también puede ir el destino (pero no la llegada)
    if (!empty($ciudadAyudar)) {
        $stmt = $conexion->prepare("INSERT INTO servicios (nombre, descripcion, usuario_ofrece_id, hora_realizar, especialidad, destino, categoria) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssissss", $nombreProducto, $descripcion, $usuario_ofrece_id, $hora, $especialidad, $ciudadAyudar, $categoria);
        
        if ($stmt->execute()) {
            $registroExitoso = true;
            header("Location: subir_producto.php?registro=exitoso");
            exit;
        } else {
            echo "Error al insertar: " . $stmt->error;
        }
    } else {
        // Si hay especialidad pero no destino, no insertamos nada en destino
        $stmt = $conexion->prepare("INSERT INTO servicios (nombre, descripcion, usuario_ofrece_id, hora_realizar, especialidad, categoria) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisss", $nombreProducto, $descripcion, $usuario_ofrece_id, $hora, $especialidad, $categoria);
        
        if ($stmt->execute()) {
            $registroExitoso = true;
            header("Location: subir_producto.php?registro=exitoso");
            exit;
        } else {
            echo "Error al insertar: " . $stmt->error;
        }
    }

} else if (!empty($destino) && !empty($llegada)) {
    // Si no hay especialidad, se valida destino y llegada
    $stmt = $conexion->prepare("INSERT INTO servicios (nombre, descripcion, usuario_ofrece_id, hora_realizar, destino, lugar_llegada, categoria) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissss", $nombreProducto, $descripcion, $usuario_ofrece_id, $hora, $destino, $llegada, $categoria);
    
    if ($stmt->execute()) {
        $registroExitoso = true;
        header("Location: subir_producto.php?registro=exitoso");
        exit;
    } else {
        echo "Error al insertar: " . $stmt->error;
    }

} else if (!empty($destino)) {
    // Solo destino sin llegada
    $stmt = $conexion->prepare("INSERT INTO servicios (nombre, descripcion, usuario_ofrece_id, hora_realizar, destino, categoria) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $nombreProducto, $descripcion, $usuario_ofrece_id, $hora, $destino, $categoria);
    
    if ($stmt->execute()) {
        $registroExitoso = true;
        header("Location: subir_producto.php?registro=exitoso");
        exit;
    } else {
        echo "Error al insertar: " . $stmt->error;
    }

} else {
    // Insertar solo lo básico
    $stmt = $conexion->prepare("INSERT INTO servicios (nombre, descripcion, usuario_ofrece_id, hora_realizar, destino, categoria) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $nombreProducto, $descripcion, $usuario_ofrece_id, $hora, $ciudadAyudar, $categoria);
    
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
