<?php include_once "header.php"; ?>
<?php
$mysqli = require_once 'connexio.php';

$sentencia = $mysqli->prepare("SELECT tec.nom, inci.idIncidencia, inci.prioritat, inci.data_inici, inci.data_fi ,sum(act.temps) as temps 
FROM TECNIC tec
join INCIDENCIA inci on inci.tecnic = tec.idTecnic
join ACTUACIO act on act.incidencia = inci.idIncidencia
group by tec.nom, inci.idIncidencia, inci.prioritat, inci.data_inici
order by tec.nom, inci.prioritat");

$sentencia->execute();

$resultat = $sentencia->get_result();
$dades = [];

while ($fila = $resultat->fetch_assoc()) {
    $dades[] = $fila;
}
?>

<h2>Informe Tecnics</h2>

<table class="table">
    <thead>
    <tr>
        <th>Tècnic</th>
        <th>Incidencia</th>
        <th>Prioritat</th>
        <th>Data inici</th>
        <th>Data fi</th>
        <th>Temps</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($dades as $fila): ?>
        <tr>
            <td><?= $fila["nom"] ?></td>
            <td><?= $fila["idIncidencia"] ?></td>
            <td><?= $fila["prioritat"] ?></td>
            <td><?= $fila["data_inici"] ?></td>
            <td><?= $fila["data_fi"] ?></td>
            <td><?= $fila["temps"] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php include_once "footer.php"; ?>
