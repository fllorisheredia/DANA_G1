<?php

$servidor = "localhost";
$usuario = "root";
<<<<<<< HEAD
$password = "1234";
$base_datos = "tiendadana";
$port = 3307;
=======
$password = "";
$base_datos = "teledana";
$port = 3306;
>>>>>>> 8d4df31deef23a9cf142b206ab7411948a372e5e

$conexion = new mysqli($servidor, $usuario, $password, $base_datos, $port);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}