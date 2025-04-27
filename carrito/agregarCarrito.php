<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['usuario'])) {
    $_SESSION['mensaje_error'] = "Debes iniciar sesión para añadir productos al carrito.";
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['usuario']['id'];
    $producto_id = intval($_POST['producto_id']);
    $cantidad = intval($_POST['cantidad']) ?: 1;

    // 1. Buscar si el producto ya está en el carrito
    $consulta = $conexion->prepare("SELECT id, cantidad FROM carrito WHERE usuario_id = ? AND producto_id = ?");
    $consulta->bind_param("ii", $usuario_id, $producto_id);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        // Producto ya existe → actualizar cantidad
        $fila = $resultado->fetch_assoc();
        $nuevaCantidad = $fila['cantidad'] + $cantidad;

        $update = $conexion->prepare("UPDATE carrito SET cantidad = ? WHERE id = ?");
        $update->bind_param("ii", $nuevaCantidad, $fila['id']);
        $update->execute();

        $_SESSION['carrito'][$producto_id] = $nuevaCantidad;  // ✅ Actualizar en sesión
        $_SESSION['mensaje_exito'] = "✅ Cantidad actualizada en el carrito.";
    } else {
        // Producto no existe → insertar nuevo
        $insert = $conexion->prepare("INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES (?, ?, ?)");
        $insert->bind_param("iii", $usuario_id, $producto_id, $cantidad);
        $insert->execute();

        $_SESSION['carrito'][$producto_id] = $cantidad;  // ✅ Añadir nuevo en sesión
        $_SESSION['mensaje_exito'] = "✅ Producto añadido al carrito.";
    }
} else {
    $_SESSION['mensaje_error'] = "⚠️ Método no permitido.";
}

// 2. Redirigir siempre
header("Location: ../cliente/paginaProductos.php");
exit();
?>