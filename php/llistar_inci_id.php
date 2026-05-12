<?php include_once "header.php"; ?>
<?php include_once "connexio_mongo.php"?>
<?php
$mysqli = require_once 'connexio.php';
$id = intval($_GET["idIncidencia"]);

$sentencia = $mysqli->prepare("SELECT *, act.descripcio as 'act_desc', inci.descripcio as 'inci_desc' FROM ACTUACIO act
    join INCIDENCIA inci on act.incidencia = inci.idIncidencia
    WHERE incidencia = ?");
$sentencia->bind_param("i", $id);
$sentencia->execute();

$resultat = $sentencia->get_result();
$dades = [];

while ($fila = $resultat->fetch_assoc()) {
    $dades[] = $fila;
}

$sentencia2 = $mysqli->prepare("SELECT descripcio as inci_desc from INCIDENCIA WHERE idIncidencia = ?");
$sentencia2->bind_param("i", $id);
$sentencia2->execute();
$resultat2 = $sentencia2->get_result();
$dades2 = $resultat2->fetch_assoc();
?>
<div class="container-mitja">

    <?php if (empty($dades2)):;?>
    <h4>No hi ha cap Incidència amb aquesta ID, si no recordes la teva ID prova a buscar per Departament.</h4>
    <?php else: ?>
    <h4>Estat Incidencia</h4>
    <?php if (empty($dades) || is_null($dades[0]["data_fi"])): ?>
        <p><b>Pendent</b></p>
    <?php else: ?>
        <p><b>Resolta</b> el dia: <?= $dades[0]["data_fi"] ?></p>
    <?php endif; ?>
    <h4>Decripció Incidencia</h4>
    <?php echo $dades2["inci_desc"] ?>
<table class="table">
    <thead>
        <tr>
            <th>Actuació</th>
            <th>Descripció</th>
            <th>Temps trigat</th>
        </tr>
    </thead>
    <tbody>
        <?php $comptador = 1; ?>
        <?php foreach ($dades as $fila): ?>
        <tr>
            <td>Actuació <?= $comptador ?></td>
            <td><?= $fila["visible"]==1 ? $fila["act_desc"] : "No hi ha informació disponible"?></td>
            <td><?= $fila["temps"] ?> min</td>
        </tr>
        <?php $comptador++; ?>
        <?php endforeach; ?>
    </tbody>
</table>
</div>

<?php endif; ?>
<?php $link = 'usuaris.php'; ?>
<?php include_once "footer.php"; ?>