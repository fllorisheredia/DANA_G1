<?php
session_start();
include_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_valorador = $_SESSION['usuario']['id'];
    $respuesta = $_POST['respuesta'] ?? '';
    $valor = ($respuesta === 'si') ? 1 : -1;

    // Valoración de un PEDIDO
    if (isset($_POST['pedido_id'])) {
        $pedido_id = $_POST['pedido_id'];

        // Obtener el proveedor real del pedido
        $stmt = $conexion->prepare("SELECT usuario_id FROM pedidos WHERE id = ?");
        $stmt->bind_param("i", $pedido_id);
        $stmt->execute();
        $stmt->bind_result($proveedor_id);
        $stmt->fetch();
        $stmt->close();

        if (!$proveedor_id) {
            http_response_code(400);
            echo "No se encontró el proveedor del pedido.";
            exit();
        }

        // Aplicar valoración al proveedor
        $query = "UPDATE usuarios SET valoracion = IFNULL(valoracion, 0) + ? WHERE id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ii", $valor, $proveedor_id);
        $stmt->execute();

        // Marcar el pedido como valorado
        $update = $conexion->prepare("UPDATE pedidos SET valorado = 1 WHERE id = ?");
        $update->bind_param("i", $pedido_id);
        $update->execute();

        echo "ok";
        exit();
    }

    // Valoración de un SERVICIO
    if (isset($_POST['servicio_id'])) {
        $servicio_id = $_POST['servicio_id'];

        // Obtener el proveedor real del servicio solicitado
        $stmt = $conexion->prepare("SELECT usuario_ofrece_id FROM servicios_solicitados WHERE servicio_id = ? AND usuario_solicita_id = ?");
        $stmt->bind_param("ii", $servicio_id, $usuario_valorador);
        $stmt->execute();
        $stmt->bind_result($proveedor_id);
        $stmt->fetch();
        $stmt->close();

        if (!$proveedor_id) {
            http_response_code(400);
            echo "No se encontró el proveedor del servicio.";
            exit();
        }

        // Aplicar valoración al proveedor
        $query = "UPDATE usuarios SET valoracion = IFNULL(valoracion, 0) + ? WHERE id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->bind_param("ii", $valor, $proveedor_id);
        $stmt->execute();

        // Marcar el servicio como valorado
        $update = $conexion->prepare("UPDATE servicios_solicitados SET valorado = 1 WHERE servicio_id = ? AND usuario_solicita_id = ?");
        $update->bind_param("ii", $servicio_id, $usuario_valorador);
        $update->execute();

        echo "ok";
        exit();
    }

    echo "Falta el ID del pedido o servicio.";
    exit();
} else {
    echo "Acceso no autorizado.";
}
?>
