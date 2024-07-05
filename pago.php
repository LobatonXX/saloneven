<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero_referencia = $_POST['numero_referencia'];
    $fecha_reservacion = $_POST['fecha_reservacion'];

    // Suponiendo que ya tienes un ID de registro y nombre asociados
    // Esto debe ser ajustado según tu lógica
    $id_registro = 1; // Debes reemplazar esto con el ID real
    $nombre = "Nombre Ejemplo"; // Debes reemplazar esto con el nombre real

    $sql = "INSERT INTO pagos (id_registro, nombre, fecha_evento, numero_referencia) VALUES (
        '$id_registro', '$nombre', '$fecha_reservacion', '$numero_referencia'
    )";

    if ($conn->query($sql) === TRUE) {
        echo "Número de referencia guardado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
