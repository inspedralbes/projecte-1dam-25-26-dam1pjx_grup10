<?php include("header.php"); ?>
<?php include_once "connexio_mongo.php"; ?>

<?php
$mysqli = require_once 'connexio.php';

$sentencia = $mysqli->prepare("SELECT
        d.nom AS departament,
        COALESCE(SUM(a.temps), 0) AS temps_total
    FROM DEPARTAMENT d
    LEFT JOIN INCIDENCIA i ON i.departament = d.idDepartament
    LEFT JOIN ACTUACIO a ON a.incidencia = i.idIncidencia
    GROUP BY d.idDepartament, d.nom
    ORDER BY d.nom");
$sentencia->execute();
$resultat = $sentencia->get_result();
$dades = [];

while ($fila = $resultat->fetch_assoc()) {
    $dades[] = $fila;
}

$tempsArray = [];
$deptsArray = [];

foreach ($dades as $fila) {
    $tempsArray[] = $fila["temps_total"];
    $deptsArray[] = $fila["departament"];
}
?>

    <div style="width: 500px; margin: 40px auto; text-align: center;">
        <h2>Temps per Departament</h2>
        <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($deptsArray); ?>,
                datasets: [{
                    label: 'Minuts',
                    data: <?php echo json_encode($tempsArray); ?>,
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56',
                        '#4BC0C0', '#9966FF', '#FF9F40'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    </script>
<?php $link = 'responsables.php' ?>
<?php include("footer.php"); ?>