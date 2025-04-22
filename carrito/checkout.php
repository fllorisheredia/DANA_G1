<?php
// session_start();
include '../includes/db.php';
include '../includes/header.php';
// verificarSesion();

$id_usuario = $_SESSION['usuario']['id'];
$total_tonkens = 0;

// Calcular total de productos en el carrito
foreach ($_SESSION['carrito'] as $id_producto => $cantidad) {
    $query = $conexion->prepare("SELECT precio_tonkens FROM productos WHERE id = ?");
    $query->bind_param("i", $id_producto);
    $query->execute();
    $resultado = $query->get_result()->fetch_assoc();
    $total_tonkens += $resultado['precio_tonkens'] * $cantidad;
}

// Crear pedido en la base de datos
$query = $conexion->prepare("INSERT INTO pedidos (usuario_id, fecha, estado, total_tonkens) VALUES (?, NOW(), 'pendiente', ?)");
$query->bind_param("ii", $id_usuario, $total_tonkens);

if ($query->execute()) {
    $pedido_id = $conexion->insert_id; // ID del pedido recién creado

    // CREAR XML PARA GUARDAR LA INFORMACIÓN DEL PEDIDO
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
        $query = $conexion->prepare("SELECT nombre, precio_tonkens FROM productos WHERE id = ?");
        $query->bind_param("i", $id_producto);
        $query->execute();
        $producto = $query->get_result()->fetch_assoc();

        $productoElement = $xml->createElement('producto');
        $productoElement->appendChild($xml->createElement('id', $id_producto));
        $productoElement->appendChild($xml->createElement('nombre', $producto['nombre']));
        $productoElement->appendChild($xml->createElement('precio_tonkens', $producto['precio_tonkens']));
        $productoElement->appendChild($xml->createElement('cantidad', $cantidad));
        $productosElement->appendChild($productoElement);
    }

    $root->appendChild($productosElement);
    $xml->appendChild($root);

    // Crear carpeta si no existe
    $carpetaXml = '../xml/pedidos/';
    if (!file_exists($carpetaXml)) {
        mkdir($carpetaXml, 0777, true);
    }

    // Guardar archivo XML localmente
    $rutaXml = $carpetaXml . "pedido_$pedido_id.xml";
    $xml->save($rutaXml);

    // Limpiar carrito después de guardar el XML
    $_SESSION['carrito'] = [];

    // Confirmación al usuario
    echo "<p>Pedido realizado con éxito.</p>";

    // Enviar correo con XML adjunto
    include '../emails/enviar_pedido.php';
    enviarCorreoPedido($_SESSION['usuario']['email'], "Tu pedido ha sido confirmado.", $rutaXml);

} else {
    echo "<p>Error al procesar el pedido.</p>";
}
?>
<a href="../index.php">Volver a la tienda</a>
<?php include '../includes/footer.php'; ?>
