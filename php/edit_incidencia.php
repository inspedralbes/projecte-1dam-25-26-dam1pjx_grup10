<?php include_once "header.php"; ?>

<?php
$mysqli = require_once 'connexio.php';
$id = intval($_GET["idIncidencia"]);

$sentencia = $mysqli->prepare("SELECT INCIDENCIA.idIncidencia, INCIDENCIA.descripcio, INCIDENCIA.data_inici, DEPARTAMENT.nom AS 'nom_dpt'
 FROM INCIDENCIA
  JOIN DEPARTAMENT ON INCIDENCIA.departament = DEPARTAMENT.idDepartament
  WHERE idIncidencia = $id");
$sentencia->execute();

$resultat = $sentencia->get_result();
$dades = [];

while ($fila = $resultat->fetch_assoc()) {
    $dades[] = $fila;
}

$sentencia2 = $mysqli->prepare("SELECT idTecnic, cognom
FROM TECNIC");

$sentencia2->execute();

$resultat2 = $sentencia2->get_result();
$dades2 = [];

while ($fila2 = $resultat2->fetch_assoc()) {
    $dades2[] = $fila2;
}


$sentencia3 = $mysqli->prepare("SELECT idTipus, nom
FROM TIPOLOGIA");

$sentencia3->execute();

$resultat3 = $sentencia3->get_result();
$dades3 = [];

while ($fila3 = $resultat3->fetch_assoc()) {
    $dades3[] = $fila3;
}
?>
<div class="container-mitja text-center">
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Descripció</th>
            <th>Data</th>
            <th>Dept</th>
            <th></th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($dades as $fila): ?>

            <tr>

                <td><?= $fila["idIncidencia"] ?></td>
                <td><?= $fila["descripcio"] ?></td>
                <td><?= $fila["data_inici"] ?></td>
                <td><?= $fila["nom_dpt"] ?></td>
                <td></td>


            </tr>


        <?php endforeach; ?>
    </tbody>
</table>
</div>
<div class="container text-center">
<form action="edit_succes.php" method="GET" name="editar_incidencia" onsubmit="return validarCampsEditInc()">
            <div class="form-group">
                <label for="prioritat">Prioritat</label>
                <select name="prioritat" id="prioritat">
                    <option value="" disabled selected>-- Selecciona la prioritat --</option>
                    <option value="Alta">Alta</option>
                    <option value="Mitja">Mitja</option>
                    <option value="Baixa">Baixa</option>

                </select>
            </div>
        <br>
        <div class="form-group">
                        <label for="tipologia">Tipologia</label>
                        <select name="tipologia" id="tipologia">
                            <option value="" disabled selected> --Selecciona la tipologia -- </option>
                                                <?php foreach ($dades3 as $fila3): ?>
                                                <option value="<?= $fila3["idTipus"] ?>"> <?= $fila3["nom"]?> </option>
                                                <?php endforeach; ?>

                        </select>
                    </div>
                <br>
            <div class="form-group">
                 <label for="idTecnic">Tècnic</label>
                    <select name="idTecnic" id="idTecnic">
                    <option value="" disabled selected> --Selecciona el tècnic -- </option>
                    <?php foreach ($dades2 as $fila2): ?>
                    <option value="<?= $fila2["idTecnic"] ?>"> <?= $fila2["cognom"]?> </option>
                    <?php endforeach; ?>
                    </select>
            </div>
        <div class="form-group"><button class="btn btn-outline-primary">Confirmar</button></div>

        <input id="idIncidencia" name="idIncidencia" type="hidden" value="<?php echo $id?>" />
        </form>
</div>


<?php $link = 'incidencies_pa.php'; ?>
<?php include_once "footer.php"; ?>