<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['usuario'])) {
    die("Debes iniciar sesión para añadir productos al carrito.");
}

$usuario_id = $_SESSION['usuario']['id'];
$producto_id = intval($_POST['producto_id']);
$cantidad = intval($_POST['cantidad']) ?: 1;

// Verificar si el producto ya está en el carrito
$consulta = $conexion->prepare("SELECT id, cantidad FROM carrito WHERE usuario_id = ? AND producto_id = ?");
$consulta->bind_param("ii", $usuario_id, $producto_id);
$consulta->execute();
$resultado = $consulta->get_result();

if ($resultado->num_rows > 0) {
    // Ya existe, actualizamos la cantidad
    $fila = $resultado->fetch_assoc();
    $nuevaCantidad = $fila['cantidad'] + $cantidad;

    $update = $conexion->prepare("UPDATE carrito SET cantidad = ? WHERE id = ?");
    $update->bind_param("ii", $nuevaCantidad, $fila['id']);
    $update->execute();
    echo "Cantidad actualizada en el carrito.";
} else {
    // No existe, lo insertamos
    $insert = $conexion->prepare("INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES (?, ?, ?)");
    $insert->bind_param("iii", $usuario_id, $producto_id, $cantidad);
    $insert->execute();
    echo "Producto añadido al carrito.";
}
?>
