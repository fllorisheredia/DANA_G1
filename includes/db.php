<?php

$servidor = "localhost";
$usuario = "root";
$password = "1234";
$base_datos = "tiendadana";
$port = 3307;

$conexion = new mysqli($servidor, $usuario, $password, $base_datos, $port);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
