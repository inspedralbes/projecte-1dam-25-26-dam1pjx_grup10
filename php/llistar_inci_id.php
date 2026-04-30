<?php include_once "header.php"; ?>
<?php
$mysqli = require_once 'connexio.php';
$id = intval($_GET["idIncidencia"]);

$sentencia = $mysqli->prepare("SELECT * FROM ACTUACIO act
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

<table class="table">
    <thead>
        <tr>
            <th>Actuació</th>
            <th>Descripció</th>
            <th>Temps trigat</th>
            <th>Data Fi</th>
        </tr>
    </thead>
    <tbody>
        <?php $comptador = 1; ?>
        <?php foreach ($dades as $fila): ?>
        <tr>
            <td>Actuació <?= $comptador ?></td>
            <td><?= $fila["visible"]==1 ? $fila["descripcio"] : "No hi ha informació disponible"?></td>
            <td><?= $fila["temps"] ?></td>
            <td><?= $fila["data_fi"] ?? "Pendent" ?></td>
        </tr>
        <?php $comptador++; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include_once "footer.php"; ?>