<?php
include '../includes/db.php';
session_start();
// Datos del formulario
$usuario_id = $_SESSION['usuario']['id'];
$nombre = $_POST['nombre'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$precio_token = $_POST['precio_tonkens'] ?? 1;
$stock = $_POST['stock'] ?? 1;
$categoria = $_POST['categoria'] ?? 'alimentos';
$registroExitoso = false;
// Validación básica
if (empty($nombre) || empty($categoria)) {
    die("❌ Faltan datos obligatorios.");
}

// Verificar si ya existe un producto con ese nombre y usuario
$consulta = $conexion->prepare("SELECT id FROM productos WHERE usuario_id = ? AND nombre = ?");
$consulta->bind_param("is", $usuario_id, $nombre);
$consulta->execute();
$resultado = $consulta->get_result();

if ($resultado->num_rows > 0) {
    // Ya existe: actualizamos sumando el nuevo stock
    $fila = $resultado->fetch_assoc();
    $producto_id = $fila['id'];

    // Obtener stock actual
    $consulta_stock = $conexion->prepare("SELECT stock FROM productos WHERE id = ?");
    $consulta_stock->bind_param("i", $producto_id);
    $consulta_stock->execute();
    $res_stock = $consulta_stock->get_result();
    $datos_stock = $res_stock->fetch_assoc();
    $stock_actual = $datos_stock['stock'];

    // Sumar el nuevo stock
    $nuevo_stock = $stock_actual + $stock;

    $actualizar = $conexion->prepare("UPDATE productos SET descripcion = ?, stock = ?, categoria = ? WHERE id = ?");
    $actualizar->bind_param("sisi", $descripcion, $nuevo_stock, $categoria, $producto_id);

    if ($actualizar->execute()) {
        $registroExitoso = true;
        echo "✅ Producto actualizado correctamente.";
    } else {
        echo "❌ Error al actualizar el producto.";
    }
} else {
    // No existe: insertamos
    $insertar = $conexion->prepare("INSERT INTO productos (usuario_id, nombre, descripcion, precio_tonkens, categoria, stock) VALUES (?, ?, ?, ?, ?, ?)");
    $insertar->bind_param("issisi", $usuario_id, $nombre, $descripcion, $precio_token, $categoria, $stock);

    if ($insertar->execute()) {
        $registroExitoso = true;
        echo "✅ Producto Subido correctamente.";
    } else {
        echo "❌ Error al subir el producto.";
    }
}

if ($registroExitoso) {
    header("Location: subir_producto.php?registro=exitoso");
    exit;
}
$conexion->close();
?>