<?php include_once "header.php"; ?>
<?php
$mysqli = require_once 'connexio.php';
$id = intval($_GET["idIncidencia"]);

$sentencia = $mysqli->prepare("SELECT *, act.descripcio as 'act_desc' FROM ACTUACIO act
    join INCIDENCIA inci on act.incidencia = inci.idIncidencia
    WHERE incidencia = ?");
$sentencia->bind_param("i", $id);
$sentencia->execute();

$resultat = $sentencia->get_result();
$dades = [];

while ($fila = $resultat->fetch_assoc()) {
    $dades[] = $fila;
}
?>
    <h4>Data Fi</h4>
    <?php if (empty($dades) || is_null($dades[0]["data_fi"])): ?>
        <p>Pendent</p>
    <?php else: ?>
        <p><?= $dades[0]["data_fi"] ?></p>
    <?php endif; ?>
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
            <td><?= $fila["temps"] ?></td>
        </tr>
        <?php $comptador++; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include_once "footer.php"; ?>