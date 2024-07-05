<?php
include 'conexion.php';

$sql = "SELECT ID_Registro, fechaEvento, horaIni, horaFin, nombre FROM registrosreservaciones";
$result = $conn->query($sql);

// Verificar errores en la consulta
if ($result === false) {
    die("Error en la consulta SQL: " . $conn->error);
}

$reservaciones = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reservaciones[] = $row;
    }
} else {
    $error_msg = "No hay reservaciones.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservaciones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .header-wrap {
            padding: 1rem;
            background-color: #a0913c;
            color: white;
            text-align: center;
        }

        ul.main-menu {
            list-style: none;
            display: flex;
            justify-content: center;
            padding: 0;
        }

        ul.main-menu li {
            margin: 0 15px;
        }

        ul.main-menu a {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
        }

        ul.main-menu a:hover {
            text-decoration: underline;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<header class="header-wrap">
    <h1>Eventos CI Excelencia</h1>
    <ul class="main-menu">
    <li class="menu-item"><a href="bienvenida.php">Inicio</a></li>
                <li class="menu-item"><a href="historial.php">Reservaciones</a></li>
                <li class="menu-item"><a href="index.html">Cerrar Sesión</a></li>
    </ul>
</header>   

<section>
    <div class="container">
        <h2>Reservaciones</h2>
        <?php if (isset($error_msg)): ?>
            <p><?php echo $error_msg; ?></p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Hora inicio</th>
                        <th>Hora fin</th>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($reservaciones)): ?>
                        <?php foreach ($reservaciones as $reservacion): ?>
                            <tr>
                                <td><?php echo $reservacion['ID_Registro']; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($reservacion['fechaEvento'])); ?></td>
                                <td><?php echo date("H:i", strtotime($reservacion['horaIni'])); ?></td>
                                <td><?php echo date("H:i", strtotime($reservacion['horaFin'])); ?></td>
                                <td><?php echo $reservacion['nombre']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No hay reservaciones.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</section>

</body>
</html>

