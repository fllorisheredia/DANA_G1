






<?php
session_start();
include_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pedido_id = $_POST['pedido_id'];
    $proveedor_id = $_POST['proveedor_id'];
    $usuario_id = $_SESSION['usuario_id'];
    $respuesta = $_POST['respuesta'];

    // Define el valor a sumar o restar
    $valor = ($respuesta === 'si') ? 1 : -1;

    // Aumenta o disminuye la valoración del proveedor
    $query = "UPDATE usuarios SET valoracion = IFNULL(valoracion, 0) + ? WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ii", $valor, $proveedor_id);

    if ($stmt->execute()) {
        header("Location: pedidosUsuario.php");
    } else {
        echo "Error al guardar la valoración: " . $conexion->error;
    }
} else {
    echo "Acceso no autorizado.";
}
?>
