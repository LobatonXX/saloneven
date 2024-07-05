<?php
include 'conexion.php';

function obtenerCitas($conn) {
    $sql = "SELECT fechaEvento FROM registrosreservaciones";
    $result = $conn->query($sql);
    
    $fechas_ocupadas = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $fechas_ocupadas[] = $row['fechaEvento'];
        }
    }
    return $fechas_ocupadas;
}

function mostrarCalendario($year, $month, $fechas_ocupadas) {
    $dias_mes = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    // Establecer la localización en español
    setlocale(LC_TIME, 'es_ES.UTF-8');
    $nombre_mes = strftime('%B', mktime(0, 0, 0, $month, 10));

    // Calcular mes y año anterior y siguiente
    $prev_month = $month - 1;
    $next_month = $month + 1;
    $prev_year = $year;
    $next_year = $year;

    if ($prev_month < 1) {
        $prev_month = 12;
        $prev_year--;
    }

    if ($next_month > 12) {
        $next_month = 1;
        $next_year++;
    }

    echo "<div class='calendario-wrapper'>";
    echo "<div class='calendario-header'>";
    echo "<a href='?year=$prev_year&month=$prev_month' class='nav-link'>&lt;&lt;</a>";
    echo "<h2>" . ucfirst($nombre_mes) . " $year</h2>";
    echo "<a href='?year=$next_year&month=$next_month' class='nav-link'>&gt;&gt;</a>";
    echo "</div>";
    
    echo "<table class='calendario'>";
    echo "<thead><tr><th>Dom</th><th>Lun</th><th>Mar</th><th>Mié</th><th>Jue</th><th>Vie</th><th>Sáb</th></tr></thead><tbody><tr>";
    
    $dia_semana = date('w', strtotime("$year-$month-01"));
    for ($i = 0; $i < $dia_semana; $i++) {
        echo "<td></td>";
    }
    
    for ($dia = 1; $dia <= $dias_mes; $dia++) {
        $fecha = "$year-$month-" . str_pad($dia, 2, '0', STR_PAD_LEFT);
        if (in_array($fecha, $fechas_ocupadas)) {
            echo "<td class='not-available'>$dia</td>";
        } else {
            echo "<td class='available'>$dia</td>";
        }
        
        if (($dia + $dia_semana) % 7 == 0) {
            echo "</tr><tr>";
        }
    }
    while (($dia + $dia_semana) % 7 != 0) {
        echo "<td></td>";
        $dia++;
    }
    echo "</tr></tbody></table>";
    echo "</div>";  // Cierre del div calendario-wrapper
}
?>
