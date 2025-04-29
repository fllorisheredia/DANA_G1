<?php
session_start();
include_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_SESSION['usuario']['id'];
    $proveedor_id = $_POST['proveedor_id'];
    $respuesta = $_POST['respuesta'];
    $valor = ($respuesta === 'si') ? 1 : -1;

    // Aumenta o disminuye la valoración del proveedor
    $query = "UPDATE usuarios SET valoracion = IFNULL(valoracion, 0) + ? WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ii", $valor, $proveedor_id);

    if (!$stmt->execute()) {
        http_response_code(500);
        echo "Error al actualizar valoración del proveedor.";
        exit();
    }

    // Detectar si se está valorando un pedido o un servicio
    if (isset($_POST['pedido_id'])) {
        $pedido_id = $_POST['pedido_id'];

        // Marcar pedido como valorado
        $update = $conexion->prepare("UPDATE pedidos SET valorado = 1 WHERE id = ?");
        $update->bind_param("i", $pedido_id);
        $update->execute();

    } elseif (isset($_POST['servicio_id'])) {
        $servicio_id = $_POST['servicio_id'];

        // Marcar servicio como valorado
        $update = $conexion->prepare("UPDATE servicios_solicitados SET valorado = 1 WHERE servicio_id = ? AND usuario_solicita_id = ?");
        $update->bind_param("ii", $servicio_id, $usuario_id);
        $update->execute();
    }

    echo "ok";
    exit();
} else {
    echo "Acceso no autorizado.";
}

?>
