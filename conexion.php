<?php
$host = "localhost";
$user = "root";
$password = "1234";
$database = "harry_potter_db";

$conexion = new mysqli($host, $user, $password, $database);

if ($conexion->connect_error) {
    die("<h3 style='color:red; text-align:center;'>Error de conexión: " . $conexion->connect_error . "</h3>");
}
?>