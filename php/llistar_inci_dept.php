<?php include_once "auth.php"?>
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

$departament = intval($_GET["departament"]) ? intval($_GET["departament"]) : 0;

$sentencia_count = $mysqli->prepare("SELECT count(*) AS num_pages FROM INCIDENCIA WHERE departament = ?");
$sentencia_count->bind_param("i", $departament);
$sentencia_count->execute();
$contador = $sentencia_count->get_result()->fetch_object()->num_pages;

$incidencies = ceil($contador / $inci_per_page);




$sentencia = $mysqli->prepare("SELECT * FROM INCIDENCIA WHERE departament = ? LIMIT ? OFFSET ?");
$sentencia->bind_param("iii", $departament, $limit, $offset);
$sentencia->execute();

$resultat = $sentencia->get_result();
$dades = [];

while ($fila = $resultat->fetch_assoc()) {
    $dades[] = $fila;
}
?>
<div class="container-mitja">
    <table class="table">
        <thead>
        <tr>
            <th>ID Incidència</th>
            <th>Descripció</th>
            <th>Data inici</th>
            <th>Estat</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php $comptador = 1; ?>
        <?php foreach ($dades as $fila): ?>
            <tr>
                <td><?= $fila["idIncidencia"] ?></td>
                <td><?= $fila["descripcio"] ?></td>
                <td><?= $fila["data_inici"] ?></td>
                <td>
                    <?php if (is_null($fila["data_fi"])): ?>
                        <p>Pendent</p>
                    <?php else: ?>
                        <p>Resolta</p>
                    <?php endif; ?>
                </td>
                <td> <a href="llistar_inci_id.php?idIncidencia=<?php echo $fila["idIncidencia"]; ?>"> Veure</a></td>
            </tr>
            <?php $comptador++; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-3">
        <?php for ($i = 1; $i <= $incidencies; $i++): ?>
            <a href="?pagina=<?= $i ?>&departament=<?= $departament ?>"
               class="btn <?= $i == $pagina ? 'btn-primary' : 'btn-outline-primary' ?> mx-1">
                <?= $i ?>
            </a>
        <?php endfor; ?>
    </div>
</div>
<?php $link = 'usuaris.php'; ?>
<?php include_once "footer.php"; ?>