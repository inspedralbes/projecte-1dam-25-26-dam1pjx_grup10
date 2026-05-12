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

$sentencia_count = $mysqli->prepare("
    SELECT COUNT(DISTINCT inci.idIncidencia) AS num_pages 
    FROM INCIDENCIA inci
    INNER JOIN TECNIC tec ON inci.tecnic = tec.idTecnic
    INNER JOIN ACTUACIO act ON act.incidencia = inci.idIncidencia
");
$sentencia_count->execute();
$contador = $sentencia_count->get_result()->fetch_object()->num_pages;

$incidencies = ceil($contador / $inci_per_page);

$sentencia = $mysqli->prepare("SELECT tec.nom, inci.idIncidencia, inci.prioritat, inci.data_inici, inci.data_fi ,sum(act.temps) as temps 
FROM TECNIC tec
join INCIDENCIA inci on inci.tecnic = tec.idTecnic
join ACTUACIO act on act.incidencia = inci.idIncidencia
group by tec.nom, inci.idIncidencia, inci.prioritat, inci.data_inici
order by tec.nom, inci.prioritat 
LIMIT ? OFFSET ?");
$sentencia->execute([$limit, $offset]);


$resultat = $sentencia->get_result();
$dades = [];

while ($fila = $resultat->fetch_assoc()) {
    $dades[] = $fila;
}
?>
<div class="container-gran text-center">
<h2>Informe Tecnics</h2>

<table class="table">
    <thead>
    <tr>
        <th>Tècnic</th>
        <th>ID Incidencia</th>
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
            <td><?= $fila["temps"] ?>min</td>
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
