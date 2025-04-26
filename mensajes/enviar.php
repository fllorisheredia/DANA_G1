<?php
session_start();
include '../includes/db.php';
// verificarSesion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $remitente_id = $_SESSION['usuario']['id'];
    $destinatario_id = $_POST['destinatario_id'];
    $mensaje = $_POST['mensaje'];

    $query = $conexion->prepare("INSERT INTO mensajes (remitente_id, destinatario_id, mensaje, fecha) VALUES (?, ?, ?, NOW())");
    $query->bind_param("iis", $remitente_id, $destinatario_id, $mensaje);
    $query->execute();

    header("Location: chat.php?id=$destinatario_id");
    exit;
}
?>
