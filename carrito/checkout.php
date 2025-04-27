<?php
session_start();
include '../includes/db.php';
include '../includes/header.php';

if (!isset($_SESSION['usuario'])) {
    die("⚠️ Debes iniciar sesión.");
}

$id_usuario = $_SESSION['usuario']['id'];
$email_usuario = $_SESSION['usuario']['email'];
$nombre_usuario = $_SESSION['usuario']['nombre'];
$total_tonkens = 0;
$mensaje = ""; // Aquí guardamos el mensaje

// Calcular total del carrito
foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
    $query = $conexion->prepare("SELECT precio_tonkens FROM productos WHERE id = ?");
    $query->bind_param("i", $id_producto);
    $query->execute();
    $resultado = $query->get_result()->fetch_assoc();
    $total_tonkens += $resultado['precio_tonkens'] * $cantidad;
}

// Obtener saldo actual del usuario
$querySaldo = $conexion->prepare("SELECT tonkens FROM usuarios WHERE id = ?");
$querySaldo->bind_param("i", $id_usuario);
$querySaldo->execute();
$usuario = $querySaldo->get_result()->fetch_assoc();
$saldo_actual = $usuario['tonkens'];

// Comprobar si el usuario tiene suficiente saldo
if ($saldo_actual < $total_tonkens) {
    $mensaje = "❌ No tienes suficientes fondos para finalizar el pedido.";
} else {
    // Descontar el saldo
    $nuevoSaldo = $saldo_actual - $total_tonkens;
    $updateSaldo = $conexion->prepare("UPDATE usuarios SET tonkens = ? WHERE id = ?");
    $updateSaldo->bind_param("di", $nuevoSaldo, $id_usuario);
    $updateSaldo->execute();

    // Crear el pedido en la base de datos
    $query = $conexion->prepare("INSERT INTO pedidos (usuario_id, fecha, estado, total_tonkens) VALUES (?, NOW(), 'pendiente', ?)");
    $query->bind_param("ii", $id_usuario, $total_tonkens);

    if ($query->execute()) {
        $pedido_id = $conexion->insert_id; // ID del nuevo pedido

        // Crear XML para el pedido
        $xml = new DOMDocument('1.0', 'UTF-8');
        $xml->formatOutput = true;

        $root = $xml->createElement('pedido');
        $root->setAttribute('id', $pedido_id);
        $root->appendChild($xml->createElement('usuario_id', $id_usuario));
        $root->appendChild($xml->createElement('fecha', date('Y-m-d H:i:s')));
        $root->appendChild($xml->createElement('estado', 'pendiente'));
        $root->appendChild($xml->createElement('total_tonkens', $total_tonkens));

        $productosElement = $xml->createElement('productos');

        foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
            $queryProducto = $conexion->prepare("SELECT nombre, precio_tonkens FROM productos WHERE id = ?");
            $queryProducto->bind_param("i", $id_producto);
            $queryProducto->execute();
            $producto = $queryProducto->get_result()->fetch_assoc();

            $productoElement = $xml->createElement('producto');
            $productoElement->appendChild($xml->createElement('id', $id_producto));
            $productoElement->appendChild($xml->createElement('nombre', $producto['nombre']));
            $productoElement->appendChild($xml->createElement('precio_tonkens', $producto['precio_tonkens']));
            $productoElement->appendChild($xml->createElement('cantidad', $cantidad));
            $productosElement->appendChild($productoElement);

            // Guardar detalle en tabla pedidos_productos
            $detalle = $conexion->prepare("INSERT INTO pedidos_productos (pedido_id, producto_id, cantidad) VALUES (?, ?, ?)");
            $detalle->bind_param("iii", $pedido_id, $id_producto, $cantidad);
            $detalle->execute();
        }

        $root->appendChild($productosElement);
        $xml->appendChild($root);

        // Crear carpeta si no existe
        $carpetaXml = '../xml/pedidos/';
        if (!file_exists($carpetaXml)) {
            mkdir($carpetaXml, 0777, true);
        }

        // Guardar el pedido en XML
        $rutaXml = $carpetaXml . "pedido_$pedido_id.xml";
        $xml->save($rutaXml);

        // Vaciar carrito en la base de datos
        $vaciarCarrito = $conexion->prepare("DELETE FROM carrito WHERE usuario_id = ?");
        $vaciarCarrito->bind_param("i", $id_usuario);
        $vaciarCarrito->execute();

        // Vaciar carrito en la sesión
        $_SESSION['carrito'] = [];

        // Cerrar correctamente la sesión para guardar cambios
        session_write_close();

        // Enviar correo con XML
        include '../emails/enviar_pedido.php';
        enviarCorreoPedido($email_usuario, "✅ Tu pedido ha sido confirmado", $rutaXml);

        $mensaje = "✅ Pedido realizado correctamente. Revisa tu correo.";
    } else {
        $mensaje = "❌ Error al procesar el pedido.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />
</head>
<body class="bg-base-200 text-base-content min-h-screen flex items-center justify-center">

<?php if (!empty($mensaje)): ?>
  <input type="checkbox" id="popup-modal" class="modal-toggle" checked />
  <div class="modal">
    <div class="modal-box bg-base-300 text-base-content">
      <h3 class="font-bold text-2xl text-center mb-4 <?= str_contains($mensaje, '✅') ? 'text-green-500' : 'text-red-500' ?>">
        <?= str_contains($mensaje, '✅') ? '¡Pedido Realizado!' : 'Error' ?>
      </h3>
      <p class="text-center mb-6"><?= $mensaje ?></p>
      <div class="flex justify-center">
        <a href="../carrito/index.php" class="btn btn-primary">Volver al carrito</a>
      </div>
    </div>
  </div>

  <!-- Script opcional para autocerrar en 4 segundos -->
  <script>
    setTimeout(() => {
      document.getElementById('popup-modal').checked = false;
    }, 4000);
  </script>
<?php endif; ?>

</body>
</html>
