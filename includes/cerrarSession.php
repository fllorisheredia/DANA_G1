<?php
session_start(); // Esto es imprescindible para poder destruir la sesión

// Elimina todas las variables de sesión
$_SESSION = [];

// Destruye la cookie de sesión si existe
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruye completamente la sesión
session_destroy();


header("Location: ../index.php");
exit;

// ✅ Opción 2 (si usas fetch con JS): devolver JSON
// echo json_encode(['status' => 'ok']);
