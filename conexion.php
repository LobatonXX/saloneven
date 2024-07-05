<?php
$servername = "server-brenda.mysql.database.azure.com";
$username = "lobaton";
$password = "Diego>brr202609";
$dbname = "salonbd"; 

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>