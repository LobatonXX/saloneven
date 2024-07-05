<?php
include 'calendario.php';

$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
$month = isset($_GET['month']) ? intval($_GET['month']) : date('m');

$fechas_ocupadas = obtenerCitas($conn);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salón de Eventos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        a {
            text-decoration: none;
        }

        a:visited {
            color: inherit;
        }

        li {
            list-style: none;
        }

        p {
            font-size: 1.1rem;
        }

        h1 {
            font-size: 2.4rem;
        }

        h2 {
            font-size: 2rem;
            margin: 1rem 0;
        }

        h3 {
            font-size: 1.8rem;
        }

        h4 {
            font-size: 1.6rem;
        }

        h5 {
            font-size: 1.4rem;
        }

        h6 {
            font-size: 1.2rem;
        }

        section {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            text-align: center;
            padding: 1em;
            background-color: #333;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .header-wrap {
            padding: .5rem .5rem;
            width: 100%;
            background-color: #a0913c;
            color: white;
            text-align: center;
        }

        ul.main-menu {
            display: flex;
            justify-content: space-between;
            padding: 0;
            margin: auto;
            width: 50%;
            z-index: 99;
            font-size: 1.1rem;
        }

        li.menu-item {
            margin: .75rem;
            display: flex;
        }

        li.menu-item a {
            color: white;
            padding: .5rem 1rem;
        }

        li.menu-item a:hover {
            color: rgb(131, 12, 12);
        }

        .calendario {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .calendario th, .calendario td {
            border: 1px solid #ddd;
            padding: 20px;
            text-align: center;
            font-size: 1.2em;
        }

        .calendario th {
            background-color: #f2f2f2;
        }

        .calendario td.available {
            background-color: #90ee90;
        }

        .calendario td.not-available {
            background-color: #ffcccb;
        }

        .calendario-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .calendario-header h2 {
            margin: 0;
            font-size: 2em;
        }

        .calendario-header .nav-link {
            text-decoration: none;
            font-size: 2em;
            color: #333;
        }

        .calendario-wrapper {
            margin: 20px auto;
            width: 100%;
        }

        .calendario-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .aviso {
            background-color: #d9f2ff;
            border: 2px solid #000;
            padding: 20px;
            margin-top: 20px;
            text-align: center;
            font-size: 1.5rem;
        }

        .aviso h3 {
            font-size: 2rem;
            margin: 0 0 10px 0;
        }

        .legend {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .legend div {
            display: flex;
            align-items: center;
        }

        .legend div span {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .legend .available {
            background-color: #90ee90;
        }

        .legend .not-available {
            background-color: #ffcccb;
        }
    </style>
</head>
<body>

<header>
    <nav class="header-wrap">
        <h1>Eventos CI Excelencia</h1>
        <ul class="main-menu">
            <li class="menu-item"><a href="index.html">Inicio</a></li>
            <li class="menu-item"><a href="eventos.html">Eventos</a></li>
            <li class="menu-item"><a href="reservaciones.html">Reservaciones</a></li>
            <li class="menu-item"><a href="fechasdis.php">Fechas Disponibles</a></li>
            <li class="menu-item"><a href="servicios.html">Servicios</a></li>
        </ul>
    </nav>
</header>   

<section>
    <div class="container">
        <h1>Calendario de Fechas disponibles</h1>
        <div class="calendario-container">
            <?php mostrarCalendario($year, $month, $fechas_ocupadas); ?>
        </div>
        <div class="legend">
            <div><span class="available"></span> Fechas disponibles</div>
            <div><span class="not-available"></span> Fechas no disponibles</div>
        </div>
        <div class="aviso">
            <h3>AVISO</h3>
            <p>PARA REALIZAR CUALQUIER RESERVACIÓN SE NECESITA EL 50% DE ANTICIPO.</p>
        </div>
    </div>
</section>

</body>
</html>
