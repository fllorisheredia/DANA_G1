<?php
// Conexión a la base de datos
// $conexion = new mysqli('localhost', 'root', '1234', 'tiendadana');

include '../includes/db.php';

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$id = $_POST['id'];
$tonkens = $_POST['tonkens'];

// Validación 
$id = intval($id);
$tonkens = intval($tonkens);

// Actualizar en la base de datos
$sql = "UPDATE usuarios SET tonkens = $tonkens WHERE id = $id";

if ($conexion->query($sql) === TRUE) {
    echo "Tonkens actualizados correctamente.";
} else {
    echo "Error al actualizar: " . $conexion->error;
}

$conexion->close();
?>
