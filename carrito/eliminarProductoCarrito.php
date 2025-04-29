<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['usuario'])) {
    die("Debes iniciar sesión.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto_id'])) {
    $usuario_id = $_SESSION['usuario']['id'];
    $producto_id = intval($_POST['producto_id']);

    // 1. Obtener la cantidad que estaba en el carrito
    $consulta = $conexion->prepare("SELECT cantidad FROM carrito WHERE usuario_id = ? AND producto_id = ?");
    $consulta->bind_param("ii", $usuario_id, $producto_id);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $cantidad = $fila['cantidad'];

        // 2. Eliminar el producto del carrito
        $eliminar = $conexion->prepare("DELETE FROM carrito WHERE usuario_id = ? AND producto_id = ?");
        $eliminar->bind_param("ii", $usuario_id, $producto_id);
        $eliminar->execute();

        // 3. Devolver esa cantidad al stock del producto
        $actualizarStock = $conexion->prepare("UPDATE productos SET stock = stock + ? WHERE id = ?");
        $actualizarStock->bind_param("ii", $cantidad, $producto_id);
        $actualizarStock->execute();
    }
}

header("Location: ../carrito/index.php"); // Cambia por la URL de tu vista de carrito si es distinta
exit();
