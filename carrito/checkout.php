<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../includes/db.php';

function mostrarMensaje($mensaje, $exito = false) {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title><?= $exito ? '¡Éxito!' : 'Error' ?></title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" />
    </head>
    <body class="min-h-screen bg-base-200 flex items-center justify-center">
        <div class="modal-box bg-base-300 p-6 rounded-xl text-center">
            <h2 class="text-3xl font-bold mb-4 <?= $exito ? 'text-green-500' : 'text-red-500' ?>">
                <?= $exito ? '¡Pedido realizado!' : 'Error' ?>
            </h2>
            <p class="mb-6"><?= $mensaje ?></p>
            <a href="../cliente/vistaInicio.php" class="btn btn-primary">Volver</a>
        </div>
    </body>
    </html>
    <?php
    exit();
}

if (!isset($_SESSION['usuario'])) {
    mostrarMensaje('⚠️ Debes iniciar sesión primero.');
}

$id_usuario = $_SESSION['usuario']['id'];

// 1. Obtener productos del carrito
$queryCarrito = $conexion->prepare("SELECT producto_id, cantidad FROM carrito WHERE usuario_id = ?");
$queryCarrito->bind_param("i", $id_usuario);
$queryCarrito->execute();
$resultadoCarrito = $queryCarrito->get_result();

if ($resultadoCarrito->num_rows === 0) {
    mostrarMensaje('❌ No tienes productos en tu carrito.');
}

$total_tonkens = 0;
$productos = [];

while ($item = $resultadoCarrito->fetch_assoc()) {
    $id_producto = $item['producto_id'];
    $cantidad = $item['cantidad'];

    $consultaProducto = $conexion->prepare("SELECT nombre, precio_tonkens, stock FROM productos WHERE id = ?");
    $consultaProducto->bind_param("i", $id_producto);
    $consultaProducto->execute();
    $producto = $consultaProducto->get_result()->fetch_assoc();

    if ($producto) {
        $total_tonkens += $producto['precio_tonkens'] * $cantidad;
        $productos[] = [
            'id' => $id_producto,
            'nombre' => $producto['nombre'],
            'precio_tonkens' => $producto['precio_tonkens'],
            'cantidad' => $cantidad,
            'stock' => $producto['stock']
        ];
    }
}

// 2. Verificar saldo del usuario
$querySaldo = $conexion->prepare("SELECT tonkens FROM usuarios WHERE id = ?");
$querySaldo->bind_param("i", $id_usuario);
$querySaldo->execute();
$usuario = $querySaldo->get_result()->fetch_assoc();
$saldo_actual = $usuario['tonkens'];

if ($saldo_actual < $total_tonkens) {
    mostrarMensaje('❌ No tienes suficientes tonkens para realizar el pedido.');
}

// 3. Descontar tonkens
$nuevoSaldo = $saldo_actual - $total_tonkens;
$updateSaldo = $conexion->prepare("UPDATE usuarios SET tonkens = ? WHERE id = ?");
$updateSaldo->bind_param("di", $nuevoSaldo, $id_usuario);
$updateSaldo->execute();

// 4. Crear pedido
$insertPedido = $conexion->prepare("INSERT INTO pedidos (usuario_id, fecha, estado, total_tonkens) VALUES (?, NOW(), 'pendiente', ?)");
$insertPedido->bind_param("ii", $id_usuario, $total_tonkens);
$insertPedido->execute();
$pedido_id = $conexion->insert_id;

// 5. Insertar detalles del pedido
foreach ($productos as $producto) {
    $insertDetalle = $conexion->prepare("INSERT INTO pedidos_productos (pedido_id, producto_id, cantidad) VALUES (?, ?, ?)");
    $insertDetalle->bind_param("iii", $pedido_id, $producto['id'], $producto['cantidad']);
    $insertDetalle->execute();

    // Actualizar stock
    $updateStock = $conexion->prepare("UPDATE productos SET stock = stock - ? WHERE id = ?");
    $updateStock->bind_param("ii", $producto['cantidad'], $producto['id']);
    $updateStock->execute();
}

// 6. Vaciar el carrito (primero SIEMPRE antes de eliminar productos)
$vaciarCarrito = $conexion->prepare("DELETE FROM carrito WHERE usuario_id = ?");
$vaciarCarrito->bind_param("i", $id_usuario);
$vaciarCarrito->execute();

// 7. Eliminar productos cuyo stock ya es 0 (eliminar relaciones antes por seguridad)
foreach ($productos as $producto) {
    $checkStock = $conexion->prepare("SELECT stock FROM productos WHERE id = ?");
    $checkStock->bind_param("i", $producto['id']);
    $checkStock->execute();
    $resultado = $checkStock->get_result();
    $stockRestante = $resultado->fetch_assoc();

    if ($stockRestante && $stockRestante['stock'] <= 0) {
        // Eliminar de carrito (por si acaso queda alguna relación)
        $deleteCarrito = $conexion->prepare("DELETE FROM carrito WHERE producto_id = ?");
        $deleteCarrito->bind_param("i", $producto['id']);
        $deleteCarrito->execute();

        // Eliminar de pedidos_productos (si no te interesa conservar el historial)
        $deleteDetalle = $conexion->prepare("DELETE FROM pedidos_productos WHERE producto_id = ?");
        $deleteDetalle->bind_param("i", $producto['id']);
        $deleteDetalle->execute();

        // Ahora sí puedes eliminar el producto
        $eliminarProducto = $conexion->prepare("DELETE FROM productos WHERE id = ?");
        $eliminarProducto->bind_param("i", $producto['id']);
        $eliminarProducto->execute();
    }
}

// 8. Crear archivo XML
$xml = new DOMDocument('1.0', 'UTF-8');
$xml->formatOutput = true;

$root = $xml->createElement('pedido');
$root->appendChild($xml->createElement('id', $pedido_id));
$root->appendChild($xml->createElement('usuario_id', $id_usuario));
$root->appendChild($xml->createElement('fecha', date('Y-m-d H:i:s')));
$root->appendChild($xml->createElement('estado', 'pendiente'));
$root->appendChild($xml->createElement('total_tonkens', $total_tonkens));

$productosElement = $xml->createElement('productos');

foreach ($productos as $producto) {
    $productoElement = $xml->createElement('producto');
    $productoElement->appendChild($xml->createElement('id', $producto['id']));
    $productoElement->appendChild($xml->createElement('nombre', $producto['nombre']));
    $productoElement->appendChild($xml->createElement('precio_tonkens', $producto['precio_tonkens']));
    $productoElement->appendChild($xml->createElement('cantidad', $producto['cantidad']));
    $productosElement->appendChild($productoElement);
}

$root->appendChild($productosElement);
$xml->appendChild($root);

if (!file_exists('../xml/pedidos')) {
    mkdir('../xml/pedidos', 0777, true);
}
$xml->save("../xml/pedidos/pedido_$pedido_id.xml");

// 9. Confirmación
mostrarMensaje('✅ Tu pedido ha sido procesado correctamente.', true);
?>
