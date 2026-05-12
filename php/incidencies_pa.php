<?php include_once "auth_respons.php"?>
<?php include_once "header.php"; ?>
<?php include_once "connexio_mongo.php"?>
<?php
$mysqli = require_once 'connexio.php';
$inci_per_page = 10;

$pagina = 1;
if (isset($_GET['pagina'])) {
    $pagina = $_GET['pagina'];
}

$limit = $inci_per_page;

$offset = ($pagina - 1) * $inci_per_page;

$sentencia_count = $mysqli->prepare("SELECT count(*) AS num_pages FROM INCIDENCIA WHERE tecnic is null");
$sentencia_count->execute();
$contador = $sentencia_count->get_result()->fetch_object()->num_pages;

$incidencies = ceil($contador / $inci_per_page);

$sentencia = $mysqli->prepare("SELECT INCIDENCIA.idIncidencia,INCIDENCIA.data_inici, DEPARTAMENT.nom AS 'nom_dpt'
 FROM INCIDENCIA
  JOIN DEPARTAMENT ON INCIDENCIA.departament = DEPARTAMENT.idDepartament
  WHERE tecnic is NULL
  ORDER BY INCIDENCIA.idIncidencia, DEPARTAMENT.idDepartament
  LIMIT ? OFFSET ?");

$sentencia->execute([$limit, $offset]);

$resultat = $sentencia->get_result();
$dades = [];

while ($fila = $resultat->fetch_assoc()) {
    $dades[] = $fila;
}
?>
<div class="container-mitja text-center">
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
                <td> <a href="edit_incidencia.php?idIncidencia=<?php echo $fila["idIncidencia"]; ?>" class="btn btn-outline-primary">Editar</a></td>

            </tr>


        <?php endforeach; ?>
    </tbody>
</table>
    <div class="d-flex justify-content-center mt-3">
        <?php for ($i = 1; $i <= $incidencies; $i++): ?>
            <a href="?pagina=<?= $i ?>"
               class="btn <?= $i == $pagina ? 'btn-primary' : 'btn-outline-primary' ?> mx-1">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
</div>
<?php $link = 'responsables.php'; ?>
<?php include_once "footer.php"; ?>