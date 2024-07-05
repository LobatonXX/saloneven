<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}

include 'conexion.php';

// Consulta para obtener los pagos
$sql_pagos = "SELECT fecha_evento, numero_referencia FROM pagos";
$result_pagos = $conn->query($sql_pagos);

$pagos = [];

if ($result_pagos === false) {
    die("Error en la consulta SQL: " . $conn->error);
}

if ($result_pagos->num_rows > 0) {
    while($row = $result_pagos->fetch_assoc()) {
        $pagos[] = $row;
    }
} else {
    $error_msg = "No hay pagos registrados.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <header>
        <nav class="header-wrap">
            <h1>Panel de Administrador</h1>
            <ul class="main-menu">
                <li class="menu-item"><a href="bienvenida.php">Inicio</a></li>
                <li class="menu-item"><a href="historial.php">Reservaciones</a></li>
                <li class="menu-item"><a href="index.html">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <h2>Bienvenido, <?php echo $_SESSION['usuario']; ?></h2>
        <div class="container">
            <?php if (isset($error_msg)): ?>
                <p><?php echo $error_msg; ?></p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Fecha del Evento</th>
                            <th>Número de Referencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pagos)): ?>
                            <?php foreach ($pagos as $pago): ?>
                                <tr>
                                    <td><?php echo isset($pago['fecha_evento']) ? date("d/m/Y", strtotime($pago['fecha_evento'])) : 'N/A'; ?></td>
                                    <td><?php echo isset($pago['numero_referencia']) ? $pago['numero_referencia'] : 'N/A'; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2">No hay pagos registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </section>

    <footer>
        &copy; 2024 Salón de Eventos "Eventos CI Excelencia"
    </footer>

</body>
</html>
