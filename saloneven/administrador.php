<?php
session_start();

// Credenciales hardcoded
define('USERNAME', 'Lobaton');
define('PASSWORD', '123456'); // En producción, utiliza un hash de la contraseña

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Verificar credenciales
    if ($user === USERNAME && $pass === PASSWORD) {
        // Usuario autenticado
        $_SESSION['usuario'] = $user;
        header("Location: bienvenida.php");
        exit();
    } else {
        // Credenciales inválidas
        echo "Invalid username or password";
    }
}
?>
