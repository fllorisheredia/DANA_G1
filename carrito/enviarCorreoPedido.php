use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviarCorreoPedido($correo, $mensaje, $rutaAdjunto = null) {
    require '../vendor/autoload.php';
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.tuservidor.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tuusuario';
        $mail->Password = 'tucontraseña';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('tienda@ejemplo.com', 'Tienda ZonaVerso');
        $mail->addAddress($correo);
        $mail->Subject = 'Confirmación de pedido';
        $mail->Body = $mensaje;

        // Adjuntar XML si existe
        if ($rutaAdjunto && file_exists($rutaAdjunto)) {
            $mail->addAttachment($rutaAdjunto);
        }

        $mail->send();
    } catch (Exception $e) {
        error_log("Error al enviar el correo: {$mail->ErrorInfo}");
    }
}
