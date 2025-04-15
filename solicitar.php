<?php
// Conexión a MySQL
include 'includes/db.php';

$_SESSION['pedido_id'] = 1;
$pedido_id = $_SESSION['pedido_id']; // Asignamos a variable

if (!$pedido_id) {
    die("Error: No se ha definido el pedido en sesión.");
}



$producto_id = 1;
$cantidad = 1;

// Verificar stock
$verifica = $conexion->prepare("SELECT stock FROM productos WHERE id = ?");
$verifica->bind_param("i", $producto_id);
$verifica->execute();
$result = $verifica->get_result();
$producto = $result->fetch_assoc();

if ($producto && $producto['stock'] >= $cantidad) {
    // Restar stock
    $restar = $conexion->prepare("UPDATE productos SET stock = stock - ? WHERE id = ?");
    $restar->bind_param("ii", $cantidad, $producto_id);
    $restar->execute();

    // Registrar en pedidos_productos
    $insertar = $conexion->prepare("
        INSERT INTO pedidos_productos (pedido_id, producto_id, cantidad)
        VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE cantidad = cantidad + VALUES(cantidad)
    ");
    $insertar->bind_param("iii", $pedido_id, $producto_id, $cantidad);
    $insertar->execute();

    echo "✅ Producto solicitado con éxito.";
} else {
    echo "❌ No hay suficiente stock.";
}

$conexion->close();
?>