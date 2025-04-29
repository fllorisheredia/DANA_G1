<?php

$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "teledana";
$port = 3306;



$conexion = new mysqli($servidor, $usuario, $password, $base_datos, $port);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}