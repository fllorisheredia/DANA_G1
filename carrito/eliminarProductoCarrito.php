<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['usuario'])) {
    $_SESSION['mensaje_error'] = " Debes iniciar sesión para eliminar productos del carrito.";
    header("Location: ../index.php"); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['usuario']['id'];
    $producto_id = intval($_POST['producto_id']);

    // Eliminamos directamente 
    $delete = $conexion->prepare("DELETE FROM carrito WHERE usuario_id = ? AND producto_id = ?");
    $delete->bind_param("ii", $usuario_id, $producto_id);

    //Verificacion apra ver si el producto esta ne el carrito
    
    if ($delete->execute() && $delete->affected_rows > 0) {
        $_SESSION['mensaje_exito'] = "Producto eliminado del carrito.";
    } else {
        $_SESSION['mensaje_error'] = " El producto no se encontró en tu carrito.";
    }
} else {
    $_SESSION['mensaje_error'] = "⚠️ Método no permitido.";
}

// Devuelve al carrito
header("Location: index.php");
exit();
?>
