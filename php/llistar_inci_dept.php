<?php include_once "header.php"; ?>
<?php
$mysqli = require_once 'connexio.php';
$departament = intval($_GET["departament"]);

$sentencia = $mysqli->prepare("SELECT * FROM INCIDENCIA WHERE departament = ?");
$sentencia->bind_param("i", $departament);
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
            <th>ID Incidència</th>
            <th>Descripció</th>
            <th>Data inici</th>
        </tr>
    </thead>
    <tbody>
        <?php $comptador = 1; ?>
        <?php foreach ($dades as $fila): ?>
        <tr>
            <td><?= $fila["idIncidencia"] ?></td>
            <td><?= $fila["descripcio"] ?></td>
            <td><?= $fila["data_inici"] ?></td>
        </tr>
        <?php $comptador++; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include_once "footer.php"; ?>