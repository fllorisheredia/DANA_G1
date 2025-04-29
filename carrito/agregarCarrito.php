<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['usuario'])) {
    die("Debes iniciar sesión.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_SESSION['usuario']['id'];
    $producto_id = intval($_POST['producto_id']);
    $cantidad = intval($_POST['cantidad']);

    // Verificar stock disponible
    $consulta = $conexion->prepare("SELECT stock FROM productos WHERE id = ?");
    $consulta->bind_param("i", $producto_id);
    $consulta->execute();
    $resultado = $consulta->get_result()->fetch_assoc();

    if (!$resultado) {
        die("Producto no encontrado.");
    }

    if ($resultado['stock'] < $cantidad) {
        die("No hay suficiente stock disponible.");
    }

    // Insertar o actualizar carrito
    $existe = $conexion->prepare("SELECT cantidad FROM carrito WHERE usuario_id = ? AND producto_id = ?");
    $existe->bind_param("ii", $usuario_id, $producto_id);
    $existe->execute();
    $res = $existe->get_result()->fetch_assoc();

    if ($res) {
        // Ya está en carrito, actualizar cantidad
        $nueva_cantidad = $res['cantidad'] + $cantidad;
        $update = $conexion->prepare("UPDATE carrito SET cantidad = ? WHERE usuario_id = ? AND producto_id = ?");
        $update->bind_param("iii", $nueva_cantidad, $usuario_id, $producto_id);
        $update->execute();
    } else {
        // No está en carrito, insertar
        $insertar = $conexion->prepare("INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES (?, ?, ?)");
        $insertar->bind_param("iii", $usuario_id, $producto_id, $cantidad);
        $insertar->execute();
    }

    // Actualizar stock del producto
    $actualizarStock = $conexion->prepare("UPDATE productos SET stock = stock - ? WHERE id = ?");
    $actualizarStock->bind_param("ii", $cantidad, $producto_id);
    $actualizarStock->execute();

    header("Location: ../cliente/paginaProductos.php"); // Vuelve a la tienda
    exit();
}
?>
