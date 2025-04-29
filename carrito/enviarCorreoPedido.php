use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviarCorreoPedido($correo, $mensaje, $rutaAdjunto = null) {
require __DIR__ . '/../vendor/autoload.php';
$mail = new PHPMailer(true);

try {
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'tucorreo@gmail.com';
$mail->Password = 'clave_de_aplicacion';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->setFrom('tucorreo@gmail.com', 'ZonaVerso');
$mail->addAddress($correo);
$mail->Subject = 'Confirmación de pedido';
$mail->Body = $mensaje;

if ($rutaAdjunto && file_exists($rutaAdjunto)) {
$mail->addAttachment($rutaAdjunto);
}

$mail->send();
} catch (Exception $e) {
echo "Error al enviar correo: {$mail->ErrorInfo}";
error_log("Error al enviar el correo: {$mail->ErrorInfo}");
}
}