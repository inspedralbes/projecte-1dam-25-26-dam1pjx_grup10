<?php include_once("header.php"); ?>


<?php
$mysqli = require_once 'connexio.php';

$sentencia = $mysqli->prepare("SELECT idTecnic, cognom
FROM TECNIC");

$sentencia->execute();

$resultat = $sentencia->get_result();
$dades = [];

while ($fila = $resultat->fetch_assoc()) {
    $dades[] = $fila;
}
?>

<div class="container-mitja">
    <div class="text-center">
        <h1>Gestió  d'Incidències Com a Tecnic</h1>
        <form action="llistar_inci_tecnic.php" method="GET" name="incidencies_tecnics" onsubmit="return validarNumTec()">
            <div class="form-group">
                <h3>Quin tècnic ets?</h3>
                <label for="idTecnic"></label>
                <select name="idTecnic" id="idTecnic">
                    <option value="" disabled selected> --Selecciona el teu nom -- </option>
                    <?php foreach ($dades as $fila): ?>
                    <option value="<?= $fila["idTecnic"] ?>"> <?= $fila["cognom"]?> </option>
                    <?php endforeach; ?>
                </select>
                <div class="form-group"><button class="btn btn-outline-primary">Trobar</button></div>
            </div>
        </form>
        <br>
    </div>
</div>
<br>

<?php $link = 'index.php'; ?>
<?php include_once("footer.php"); ?>
