<?php include_once "header.php"; ?>
<?php
$mysqli = require_once 'connexio.php';


$sentencia = $mysqli->prepare("SELECT
        d.nom AS departament,
        COUNT(DISTINCT i.idIncidencia) AS total_incidencies,
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
?>

<h2>Informe per departaments</h2>

<table class="table">
    <thead>
        <tr>
            <th>Nom Departament</th>
            <th>#Incidències</th>
            <th>Temps dedicat</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dades as $fila): ?>
        <tr>
            <td><?= $fila["departament"] ?></td>
            <td><?= $fila["total_incidencies"]?></td>
            <td><?= $fila["temps_total"] ?></td>
        </tr>

        <?php endforeach; ?>
    </tbody>
</table>



<?php $link = 'responsables.php'; ?>
<?php include_once "footer.php"; ?>