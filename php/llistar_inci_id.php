<?php include_once "header.php"; ?>
<?php
$mysqli = require_once 'connexio.php';
$id = intval($_POST["idIncidencia"]);

$sentencia = $mysqli->prepare("SELECT * FROM ACTUACIO WHERE incidencia = ?");
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
        </tr>
    </thead>
    <tbody>
        <?php $comptador = 1; ?>
        <?php foreach ($dades as $fila): ?>
        <tr>
            <td>Actuació <?= $comptador ?></td>
            <td><?= $fila["descripcio"] ?></td>
            <td><?= $fila["temps"] ?></td>
        </tr>
        <?php $comptador++; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include_once "footer.php"; ?>