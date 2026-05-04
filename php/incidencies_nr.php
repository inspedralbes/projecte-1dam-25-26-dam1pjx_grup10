<?php include_once "header.php"; ?>
<?php
$mysqli = require_once 'connexio.php';

$sentencia = $mysqli->prepare("SELECT INCIDENCIA.idIncidencia, INCIDENCIA.descripcio, DEPARTAMENT.nom AS 'dep_nom', TIPOLOGIA.nom as 'tipus_nom', INCIDENCIA.prioritat, TECNIC.nom as 'tecnic_nom', COUNT(ACTUACIO.idACTUACIO) AS 'Num. Actuacions' 
FROM INCIDENCIA 
join DEPARTAMENT on INCIDENCIA.departament = DEPARTAMENT.idDepartament
left join TIPOLOGIA on INCIDENCIA.tipologia = TIPOLOGIA.idTipus
left join TECNIC on INCIDENCIA.tecnic = TECNIC.idTecnic
left join ACTUACIO on INCIDENCIA.idIncidencia = ACTUACIO.incidencia
WHERE data_fi is NULL
group by INCIDENCIA.idIncidencia
order by INCIDENCIA.prioritat, INCIDENCIA.idIncidencia");

$sentencia->execute();

$resultat = $sentencia->get_result();
$dades = [];

while ($fila = $resultat->fetch_assoc()) {
    $dades[] = $fila;
}
?>

<h2>Incidencies no Resoltes</h2>

<table class="table">
    <thead>
    <tr>
        <th>ID Incidència</th>
        <th>Descripció</th>
        <th>Departament</th>
        <th>Tipologia</th>
        <th>Prioritat</th>
        <th>Técnic</th>
        <th>#Act</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($dades as $fila): ?>
        <tr <?php if ($fila['prioritat'] == 'Alta'){ echo 'class="table-danger"';} elseif ($fila['prioritat'] == 'Mitja'){echo 'class="table-warning"';}
        elseif ($fila['prioritat'] == 'Baixa'){echo 'class="table-info"';}?>>

            <td><?= $fila["idIncidencia"] ?></td>
            <td><?= $fila["descripcio"] ?></td>
            <td><?= $fila["dep_nom"] ?></td>
            <td><?= $fila["tipus_nom"] ?></td>
            <td><?= $fila["prioritat"] ?></td>
            <td><?= $fila["tecnic_nom"] ?></td>
            <td><?= $fila["Num. Actuacions"] ?></td>
        </tr>

    <?php endforeach; ?>
    </tbody>
</table>

<?php $link = 'responsables.php'; ?>
<?php include_once "footer.php"; ?>
