



<?php
session_start();
include_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servicio_id = $_POST['servicio_id']; // corregido
    $proveedor_id = $_POST['proveedor_id'];
    $usuario_id = $_SESSION['usuario']['id']; // corregido: $_SESSION['usuario']['id']
    $respuesta = $_POST['respuesta'];

    // Define el valor a sumar o restar
    $valor = ($respuesta === 'si') ? 1 : -1;

    // Aumenta o disminuye la valoración del proveedor
    $query = "UPDATE usuarios SET valoracion = IFNULL(valoracion, 0) + ? WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("ii", $valor, $proveedor_id);

    if ($stmt->execute()) {
        // Marcar como valorado
        $update = $conexion->prepare("
            UPDATE servicios_solicitados 
            SET valorado = 1 
            WHERE servicio_id = ? AND usuario_solicita_id = ?
        ");
        $update->bind_param("ii", $servicio_id, $usuario_id);
        $update->execute();
    
        echo "ok"; // ✅ RESPUESTA para fetch
        exit();
    } else {
        http_response_code(500); // para que fetch detecte error
        echo "Error al guardar la valoración: " . $conexion->error;
    }
    
} else {
    echo "Acceso no autorizado.";
}
?>
