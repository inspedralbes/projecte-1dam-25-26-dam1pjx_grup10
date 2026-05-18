<?php include_once "auth_respons.php"?>
<?php include_once "header.php"; ?>
<?php include_once "connexio_mongo.php"?>
<?php
$mysqli = require_once 'connexio.php';
$inci_per_page = 10;

$pagina = 1;
if (isset($_GET['pagina'])) {
    $pagina = $_GET['pagina'];
}

$limit = $inci_per_page;

$offset = ($pagina - 1) * $inci_per_page;

$sentencia_count = $mysqli->prepare("SELECT count(*) AS num_pages FROM INCIDENCIA where data_fi is null");
$sentencia_count->execute();
$contador = $sentencia_count->get_result()->fetch_object()->num_pages;

$incidencies = ceil($contador / $inci_per_page);

$sentencia = $mysqli->prepare("SELECT INCIDENCIA.idIncidencia, INCIDENCIA.descripcio, DEPARTAMENT.nom AS 'dep_nom', TIPOLOGIA.nom as 'tipus_nom', INCIDENCIA.prioritat, TECNIC.nom as 'tecnic_nom', COUNT(ACTUACIO.idACTUACIO) AS 'Num. Actuacions' 
FROM INCIDENCIA 
join DEPARTAMENT on INCIDENCIA.departament = DEPARTAMENT.idDepartament
left join TIPOLOGIA on INCIDENCIA.tipologia = TIPOLOGIA.idTipus
left join TECNIC on INCIDENCIA.tecnic = TECNIC.idTecnic
left join ACTUACIO on INCIDENCIA.idIncidencia = ACTUACIO.incidencia
WHERE data_fi is NULL
group by INCIDENCIA.idIncidencia
order by INCIDENCIA.prioritat, INCIDENCIA.idIncidencia
LIMIT ? OFFSET ?");
$sentencia->execute([$limit, $offset]);


$resultat = $sentencia->get_result();
$dades = [];

while ($fila = $resultat->fetch_assoc()) {
    $dades[] = $fila;
}
?>
<div class="container-gran text-center">
<h2>Incidències no Resoltes</h2>

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
    <div class="d-flex justify-content-center mt-3">
        <?php for ($i = 1; $i <= $incidencies; $i++): ?>
            <a href="?pagina=<?= $i ?>"
               class="btn <?= $i == $pagina ? 'btn-primary' : 'btn-outline-primary' ?> mx-1">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
</div>
<?php $link = 'responsables.php'; ?>
<?php include_once "footer.php"; ?>
