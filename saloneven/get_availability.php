<?php
$serverName = "tu_servidor";
$connectionOptions = array(
    "Database" => "tu_base_de_datos",
    "Uid" => "tu_usuario",
    "PWD" => "tu_contraseña"
);

// Conexión con la base de datos
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Consulta SQL para obtener la disponibilidad
$sql = "SELECT DAY(Fecha) AS day, COUNT(*) AS count FROM Reservaciones WHERE MONTH(Fecha) = MONTH(GETDATE()) GROUP BY DAY(Fecha)";
$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$availability = array_fill(1, 30, true);  // Asume que todos los días están disponibles inicialmente
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $availability[$row['day']] = $row['count'] == 0;  // Marca como no disponible si hay una reservación
}

// Cerrar la conexión
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

// Devolver la disponibilidad en formato JSON
header('Content-Type: application/json');
echo json_encode($availability);
?>
