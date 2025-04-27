<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['usuario'])) {
    $_SESSION['mensaje_error'] = "Debes iniciar sesión para añadir productos al carrito.";
    header("Location: ../login.php");  //  la página de login
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['usuario']['id'];
    $producto_id = intval($_POST['producto_id']);
    $cantidad = intval($_POST['cantidad']) ?: 1;

    // Verificar si ya existe en el carrito
    $consulta = $conexion->prepare("SELECT id, cantidad FROM carrito WHERE usuario_id = ? AND producto_id = ?");
    $consulta->bind_param("ii", $usuario_id, $producto_id);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $nuevaCantidad = $fila['cantidad'] + $cantidad;

        $update = $conexion->prepare("UPDATE carrito SET cantidad = ? WHERE id = ?");
        $update->bind_param("ii", $nuevaCantidad, $fila['id']);
        $update->execute();
        $_SESSION['mensaje_exito'] = "✅ Cantidad actualizada en el carrito.";
    } else {
        $insert = $conexion->prepare("INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES (?, ?, ?)");
        $insert->bind_param("iii", $usuario_id, $producto_id, $cantidad);
        $insert->execute();
        $_SESSION['mensaje_exito'] = "✅ Producto añadido al carrito.";
    }
} else {
    $_SESSION['mensaje_error'] = "⚠️ Método no permitido.";
}

header("Location: ../cliente/vistaInicio.php"); // Redirige después de agregar
exit();
?>
