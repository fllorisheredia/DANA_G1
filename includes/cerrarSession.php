<?php
// session_start();

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

// Devuelve respuesta JSON (para usar con JS)
// echo json_encode(['status' => 'ok']);
?>