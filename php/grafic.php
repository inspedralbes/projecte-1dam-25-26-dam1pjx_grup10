<?php include_once "auth.php"?>
<?php include("header.php"); ?>
<?php include_once "connexio_mongo.php"; ?>

<?php
$mysqli = require_once 'connexio.php';

$sentencia = $mysqli->prepare("
    SELECT
        d.nom AS departament,
        COALESCE(SUM(a.temps), 0) AS temps_total
    FROM DEPARTAMENT d
    LEFT JOIN INCIDENCIA i ON i.departament = d.idDepartament
    LEFT JOIN ACTUACIO a ON a.incidencia = i.idIncidencia
    GROUP BY d.idDepartament, d.nom
    ORDER BY d.nom
");
$sentencia->execute();
$resultat = $sentencia->get_result();
$dades = [];
while ($fila = $resultat->fetch_assoc()) {
    $dades[] = $fila;
}

$tempsArray = [];
$deptsArray1 = [];
foreach ($dades as $fila) {
    $tempsArray[]  = $fila["temps_total"];
    $deptsArray1[] = $fila["departament"];
}
?>

    <div style="width: 500px; margin: 40px auto; text-align: center;">
        <h2>Temps per Departament</h2>
        <canvas id="chartTemps"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('chartTemps'), {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($deptsArray1); ?>,
                datasets: [{
                    label: 'Minuts',
                    data: <?php echo json_encode($tempsArray); ?>,
                    backgroundColor: ['#FF6384','#36A2EB','#FFCE56','#4BC0C0','#9966FF','#FF9F40'],
                    borderWidth: 1
                }]
            },
            options: { plugins: { legend: { position: 'bottom' } } }
        });
    </script>

<?php
$sentencia2 = $mysqli->prepare("
    SELECT
        d.nom AS departament,
        COUNT(i.idIncidencia) AS incidencies_totals
    FROM DEPARTAMENT d
    LEFT JOIN INCIDENCIA i ON i.departament = d.idDepartament
    GROUP BY d.idDepartament, d.nom
    ORDER BY d.nom
");
$sentencia2->execute();
$resultat2 = $sentencia2->get_result();
$dades2 = [];
while ($fila = $resultat2->fetch_assoc()) {
    $dades2[] = $fila;
}

$incidenciesArray = [];
$deptsArray2 = [];
foreach ($dades2 as $fila) {
    $incidenciesArray[] = $fila["incidencies_totals"];
    $deptsArray2[]      = $fila["departament"];
}
?>

    <div style="width: 500px; margin: 40px auto; text-align: center;">
        <h2>Incidències per Departament</h2>
        <canvas id="chartIncidencies"></canvas>
    </div>

    <script>
        new Chart(document.getElementById('chartIncidencies'), {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($deptsArray2); ?>,
                datasets: [{
                    label: 'Incidències',
                    data: <?php echo json_encode($incidenciesArray); ?>,
                    backgroundColor: ['#FF6384','#36A2EB','#FFCE56','#4BC0C0','#9966FF','#FF9F40'],
                    borderWidth: 1
                }]
            },
            options: { plugins: { legend: { position: 'bottom' } } }
        });
    </script>

<?php $link = 'responsables.php'; ?>
<?php include("footer.php"); ?>