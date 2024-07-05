<?php
$host = 'localhost';
$db = 'salonbd';
$user = 'root';
$pass = '';

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>