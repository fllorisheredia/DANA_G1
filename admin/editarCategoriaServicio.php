<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y limpiar entrada
    $id = isset($_POST['servicio_id']) ? intval($_POST['servicio_id']) : 0;
    $estado = isset($_POST['categoria']) ? trim($_POST['categoria']) : '';

    // Validar datos
    $estados_validos = ['bricolaje', 'alimento', 'transporte', 'limpieza'];

    if ($id > 0 && in_array($estado, $estados_validos)) {
        $stmt = $conexion->prepare("UPDATE servicios SET categoria = ? WHERE id = ?");
        $stmt->bind_param("si", $estado, $id);

        if ($stmt->execute()) {
            echo "ok";
        } else {
            http_response_code(500);
            echo "Error al actualizar el estado.";
        }
    } else {
        http_response_code(400);
        echo "Datos inválidos.";
    }
} else {
    http_response_code(405);
    echo "Método no permitido.";
}
?>