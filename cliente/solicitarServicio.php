<?php
session_start();
include '../includes/db.php';

// Verificar que el usuario esté logueado
if (!isset($_SESSION['usuario']['id'])) {
    header('Location: ../login.php');
    exit();
}

// Verificar si el servicio existe
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['servicio_id'])) {
    $servicio_id = (int)$_POST['servicio_id'];

    // Obtener info del servicio y el voluntario
    $query = $conexion->prepare("
        SELECT s.nombre, u.nombre AS voluntario_nombre, u.email AS voluntario_email 
        FROM servicios s
        JOIN usuarios u ON s.usuario_ofrece_id = u.id
        WHERE s.id = ?
    ");
    $query->bind_param("i", $servicio_id);
    $query->execute();
    $result = $query->get_result();

    if ($servicio = $result->fetch_assoc()) {
        // Simular "enviar" mensaje de móvil (en producción usarías una API como Twilio)
        // Simular envío de correo al voluntario
        $to = $servicio['voluntario_email'];
        $subject = "Solicitud de tu servicio: " . $servicio['nombre'];
        $message = "¡Hola " . $servicio['voluntario_nombre'] . "!\n\nUn usuario ha solicitado tu servicio: " . $servicio['nombre'] . ".\n\n¡Ponte en contacto cuanto antes!";
        $headers = "From: ayuda@pueblounido.com";

        @mail($to, $subject, $message, $headers);

        // Redirigir de vuelta con confirmación
        header("Location: paginaServicios.php?solicitud=ok");
        exit();
    } else {
        echo "<div class='alert alert-error'>❌ Servicio no encontrado.</div>";
    }
} else {
    echo "<div class='alert alert-error'>❌ Solicitud inválida.</div>";
}
?>
