<?php
$para = 'pueblounidodana@gmail.com';
$titulo = 'Correo de prueba desde XAMPP';
$mensaje = 'Este es un mensaje enviado desde la función mail() en localhost.';
$cabeceras = 'From: tucorreo@gmail.com';

if (mail($para, $titulo, $mensaje, $cabeceras)) {
    echo '✅ Correo enviado correctamente.';
} else {
    echo '❌ Error al enviar el correo.';
}
?>
