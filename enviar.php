<?php
// Conexión a la base de datos
$servername = "server-brenda.mysql.database.azure.com";
$username = "lobaton";
$password = "Diego>brr202609";
$dbname = "salonbd"; 

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener datos del formulario con verificación
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
$correo = isset($_POST['correo']) ? $_POST['correo'] : '';
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
$tipoEvento = isset($_POST['evento']) ? $_POST['evento'] : '';
$fechaEvento = isset($_POST['fechaEvento']) ? $_POST['fechaEvento'] : '';
$horaInicio = isset($_POST['horaIni']) ? $_POST['horaIni'] : '';
$horaTermino = isset($_POST['horaFin']) ? $_POST['horaFin'] : '';
$servicioAdicional = isset($_POST['serviciosAd']) ? $_POST['serviciosAd'] : '';
$paquete = isset($_POST['menu']) ? implode(", ", $_POST['menu']) : '';
$entrada = isset($_POST['entrada']) ? $_POST['entrada'] : '';
$segundoTiempo = isset($_POST['segundoT']) ? $_POST['segundoT'] : '';
$platoFuerte = isset($_POST['platoF']) ? $_POST['platoF'] : '';
$guarnicion = isset($_POST['guarniciones']) ? $_POST['guarniciones'] : '';
$observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : '';

// Insertar datos en la tabla
$sql = "INSERT INTO registrosreservaciones (nombre, telefono, correo, direccion, evento, fechaEvento, horaIni, horaFin, servicioAd, paquete, entrada, segundoT, platoF, guarniciones, observaciones)
VALUES ('$nombre', '$telefono', '$correo', '$direccion', '$tipoEvento', '$fechaEvento', '$horaInicio', '$horaTermino', '$servicioAdicional', '$paquete', '$entrada', '$segundoTiempo', '$platoFuerte', '$guarnicion', '$observaciones')";

if ($conn->query($sql) === TRUE) {
    echo "Reservación realizada exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
