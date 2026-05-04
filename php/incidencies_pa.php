<?php include_once "header.php"; ?>
<?php
$mysqli = require_once 'connexio.php';

$sentencia = $mysqli->prepare("SELECT INCIDENCIA.idIncidencia,INCIDENCIA.data_inici, DEPARTAMENT.nom AS 'nom_dpt'
 FROM INCIDENCIA
  JOIN DEPARTAMENT ON INCIDENCIA.departament = DEPARTAMENT.idDepartament
  WHERE tecnic is NULL
  ORDER BY INCIDENCIA.idIncidencia, DEPARTAMENT.idDepartament");
$sentencia->execute();

$resultat = $sentencia->get_result();
$dades = [];

while ($fila = $resultat->fetch_assoc()) {
    $dades[] = $fila;
}
?>

<h2>Incidencies Pendents d'Assignar</h2>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Dept</th>
            <th></th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($dades as $fila): ?>

            <tr>

                <td><?= $fila["idIncidencia"] ?></td>
                <td><?= $fila["data_inici"] ?></td>
                <td><?= $fila["nom_dpt"] ?></td>
                <td></td>
                <td> <a href="edit_incidencia.php?idIncidencia=<?php echo $fila["idIncidencia"]; ?>">Editar</a></td>

            </tr>


        <?php endforeach; ?>
    </tbody>
</table>
<?php $link = 'responsables.php'; ?>
<?php include_once "footer.php"; ?>