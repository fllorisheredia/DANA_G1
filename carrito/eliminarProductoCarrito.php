<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['usuario'])) {
    $_SESSION['mensaje_error'] = "⚠️ Debes iniciar sesión para eliminar productos del carrito.";
    header("Location: ../index.php"); // Cambia al archivo donde quieras que regrese
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['usuario']['id'];
    $producto_id = intval($_POST['producto_id']);

    // Verificar si el producto existe en el carrito
    $consulta = $conexion->prepare("SELECT id FROM carrito WHERE usuario_id = ? AND producto_id = ?");
    $consulta->bind_param("ii", $usuario_id, $producto_id);
    $consulta->execute();
    $resultado = $consulta->get_result();

    if ($resultado->num_rows > 0) {
        // Producto encontrado, lo eliminamos
        $fila = $resultado->fetch_assoc();
        $delete = $conexion->prepare("DELETE FROM carrito WHERE id = ?");
        $delete->bind_param("i", $fila['id']);
        $delete->execute();

        $_SESSION['mensaje_exito'] = "✅ Producto eliminado del carrito.";
    } else {
        $_SESSION['mensaje_error'] = "❌ El producto no se encontró en tu carrito.";
    }
} else {
    $_SESSION['mensaje_error'] = "⚠️ Método no permitido.";
}

header("Location: ../cliente/dashboardCliente.php"); // Redirige después de eliminar
exit();
?>
