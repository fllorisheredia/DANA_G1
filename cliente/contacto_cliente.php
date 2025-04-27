<?php
session_start();
include '../includes/db.php';
include '../includes/header_cliente.php';
// session_start();

$mensaje = "";
$tipoAlerta = "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $m_subject = htmlspecialchars(trim($_POST['subject'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    if (empty($name) || empty($email) || empty($m_subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "Por favor, completa todos los campos correctamente.";
        $tipoAlerta = "alert-error";
    } else {
        $to = "grpdana1@gmail.com";
        $subject = "$m_subject: $name";
        $body = "Has recibido un nuevo mensaje desde el formulario de contacto.\n\n" .
                "Nombre: $name\nCorreo: $email\nAsunto: $m_subject\n\nMensaje:\n$message";
        $headers = "From: $email\r\nReply-To: $email\r\n";

        if (mail($to, $subject, $body, $headers)) {
            $mensaje = "Mensaje enviado correctamente. ¡Gracias por contactarnos!";
            $tipoAlerta = "alert-success";
        } else {
            $mensaje = "Error: No se pudo enviar el mensaje. Inténtalo más tarde.";
            $tipoAlerta = "alert-error";
        }
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.3/dist/full.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>

<main class="min-h-screen flex items-center justify-center bg-base-100">

    <section class="w-full max-w-xl bg-gray-800 p-8 rounded-xl shadow-md space-y-6">

        <div class="flex justify-center mx-auto">
            <img class="w-auto sm:h-20" src="../img/logoSinF.png" alt="Logo">
        </div>

        <h1 class="text-3xl font-bold text-center text-gray-600 dark:text-gray-200">Formulario de Contacto</h1>

        <?php if (!empty($mensaje)): ?>
        <div class="alert <?= $tipoAlerta ?>">
            <span><?= $mensaje ?></span>
        </div>
        <?php endif; ?>

        <form action="contacto_cliente.php" method="POST" class="space-y-4">
            <div>
                <label for="name" class="block text-lg font-medium text-gray-300">Nombre:</label>
                <input type="text" id="name" name="name"
                    class="input input-bordered border-violet-700 w-full text-lg py-3 mt-2"
                    placeholder="Ingrese su nombre" required>
            </div>

            <div>
                <label for="email" class="block text-lg font-medium text-gray-300">Correo Electrónico:</label>
                <input type="email" id="email" name="email" class="input input-bordered w-full text-lg py-3 mt-2"
                    placeholder="Ingrese su correo electrónico" required>
            </div>

            <div>
                <label for="subject" class="block text-lg font-medium text-gray-300l">Asunto:</label>
                <input type="text" id="subject" name="subject" class="input input-bordered w-full text-lg py-3 mt-2"
                    placeholder="Ingrese el asunto de contacto" required>
            </div>

            <div>
                <label for="message" class="block text-lg font-medium text-gray-300l">Mensaje:</label>
                <textarea id="message" name="message" class="textarea textarea-bordered w-full text-lg py-3 mt-2"
                    rows="5" placeholder="Ingrese el mensaje" required></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary w-full">Enviar Mensaje</button>
            </div>
        </form>
        <div class="w-full max-w-sm mx-auto overflow-hidden rounded-lg shadow-md dark:bg-gray-800">


        </div>
    </section>
</main>

<?php
include '../includes/footer.php';
?>