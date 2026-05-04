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
?>

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

<form action="edit_succes.php" method="GET">
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
                            <option value="" disabled selected>-- Selecciona la tipologia --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>

                        </select>
                    </div>
                <br>
            <div class="form-group">
                <label for="tecnic">Tècnic</label>
                       <textarea name="tecnic" placeholder="Indica l'ID del tècnic assignat"></textarea>
                   </div>
        <div class="form-group"><button class="btn btn-success">Confirmar</button></div>

        <input id="idIncidencia" name="idIncidencia" type="hidden" value="<?php echo $id?>" />
        </form>



<?php $link = 'incidencies_pa.php'; ?>
<?php include_once "footer.php"; ?>