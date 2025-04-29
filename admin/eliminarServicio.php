<?php
include '../includes/db.php'; // Asegúrate de que la ruta es correcta

// Mostrar errores para depuración (puedes quitar esto en producción)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Validar que se use POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener y validar el ID del servicio
    $id = isset($_POST['servicio_id']) ? intval($_POST['servicio_id']) : 0;

    if ($id > 0) {
        // Preparar y ejecutar la eliminación
        $stmt = $conexion->prepare("DELETE FROM servicios WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "Servicio eliminado correctamente.";
        } else {
            http_response_code(500);
            echo "Error al eliminar el servicio.";
        }

        $stmt->close();
    } else {
        http_response_code(400);
        echo "ID de servicio no válido.";
    }
} else {
    http_response_code(405);
    echo "Método no permitido.";
}
?>
