<?php
session_start(); // Inicia la sesión si no está iniciada

// Destruye todas las variables de sesión
$_SESSION = array();

// Si se desea destruir la sesión completamente, también se destruye la cookie de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

// Finalmente, destruye la sesión
session_destroy();

// Redirige al usuario al login o a la página principal
header("Location: ../index.php");
exit;
?>
