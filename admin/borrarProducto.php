<?php
session_start();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Content-Type: text/plain; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $idProducto = $_POST['id'] ?? null;

    if ($idProducto) {
        // 👉 Aquí conectamos a la base de datos correcta
        $conn = new mysqli('localhost', 'root', '', 'tiendadana'); // <- Cambiado aquí

        if ($conn->connect_error) {
            http_response_code(500);
            die("❌ Error de conexión a la base de datos: " . $conn->connect_error);
        }

        $idProducto = intval($idProducto); // Seguridad: convertir a número

        // 👉 Aquí hacemos la eliminación
        $query = "DELETE FROM productos WHERE id = $idProducto";

        if ($conn->query($query)) {
            echo "✅ Producto eliminado correctamente.";
        } else {
            http_response_code(500);
            echo "❌ Error al eliminar el producto: " . $conn->error;
        }

        $conn->close();
    } else {
        http_response_code(400);
        echo "❌ ID de producto no proporcionado.";
    }
} else {
    http_response_code(405);
    echo "❌ Método no permitido.";
}
?>
