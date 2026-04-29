<?php include_once "header.php"; ?>
<?php
$mysqli = require_once 'connexio.php';
$idTecnic = $_GET['idTecnic'];
$sentencia = $mysqli->prepare("SELECT INCIDENCIA.idIncidencia, INCIDENCIA.prioritat
FROM INCIDENCIA 
join TECNIC on INCIDENCIA.tecnic = TECNIC.idTecnic
WHERE tecnic =?");

$sentencia->bind_param("i", $idTecnic);

$sentencia->execute();

$resultat = $sentencia->get_result();
$dades = [];

while ($fila = $resultat->fetch_assoc()) {
    $dades[] = $fila;
}
?>
    <h1>Llistat d'incidències assignades</h1>
        <tbody>
        <h3>Prioritat Alta</h3>
        <thead>
        <tr>
            <th>ID Incidència</th>
        </tr>
        </thead>
        <table class="table">
        <?php foreach ($dades as $fila): ?>
        <?php if ($fila['prioritat'] == 'Alta'): ?>
            <tr>
                <td><?= $fila["idIncidencia"] ?></td>
                <td> <a href="crear_act.php?idIncidencia=<?php echo $fila["idIncidencia"]; ?>">Crear Actuacio</a></td>
            </tr>
        <?php endif; ?>
        <?php endforeach; ?>
        </table>
        <h3>Prioritat Mitja</h3>
        <thead>
        <tr>
            <th>ID Incidència</th>
        </tr>
        </thead>
        <table class="table">
        <?php foreach ($dades as $fila): ?>
        <?php if ($fila['prioritat'] == 'Mitja'): ?>
            <tr>
                <td><?= $fila["idIncidencia"] ?></td>
                <td> <a href="crear_act.php?idIncidencia=<?php echo $fila["idIncidencia"]; ?>">Crear Actuacio</a></td>
            </tr>
        <?php endif; ?>
        <?php endforeach; ?>
        </table>
        <h3>Prioritat Baixa</h3>
        <thead>
        <tr>
            <th>ID Incidència</th>
        </tr>
        </thead>
        <table class="table">
        <?php foreach ($dades as $fila): ?>
        <?php if ($fila['prioritat'] == 'Baixa'): ?>
            <tr>
                <td><?= $fila["idIncidencia"] ?></td>
                <td> <a href="crear_act.php?idIncidencia=<?php echo $fila["idIncidencia"]; ?>">Crear Actuacio</a></td>
            </tr>
        <?php endif; ?>
        <?php endforeach; ?>
        </table>
        </tbody>

<?php include_once "footer.php"; ?>