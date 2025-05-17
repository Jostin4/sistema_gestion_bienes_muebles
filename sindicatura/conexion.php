<?php
$host = "localhost";
$user = "root";
$pass = ""; // Cambia si tienes contraseña
$db = "bienes"; // o el nombre que uses

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
