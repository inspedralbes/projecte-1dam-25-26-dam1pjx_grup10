<?php include_once "auth_tecnic.php"?>
<?php include_once "header.php"; ?>
<?php include_once "connexio_mongo.php"?>
    <style>
        .table {
            table-layout: fixed;
            width: 100%;
        }

        .table th:nth-child(1), .table td:nth-child(1) { width: 15%; }
        .table th:nth-child(2), .table td:nth-child(2) { width: 40%; }
        .table th:nth-child(3), .table td:nth-child(3) { width: 30%; }
        .table th:nth-child(4), .table td:nth-child(4) { width: 15%; }
    </style>
<?php
$mysqli = require_once 'connexio.php';
$idTecnic = $_GET['idTecnic'];
$sentencia = $mysqli->prepare("SELECT INCIDENCIA.idIncidencia, INCIDENCIA.prioritat, INCIDENCIA.descripcio, DEPARTAMENT.nom
FROM INCIDENCIA 
join TECNIC on INCIDENCIA.tecnic = TECNIC.idTecnic
join DEPARTAMENT on INCIDENCIA.departament =  DEPARTAMENT.idDepartament
WHERE tecnic =? and data_fi is NULL");

$sentencia->bind_param("i", $idTecnic);

$sentencia->execute();

$resultat = $sentencia->get_result();
$dades = [];

while ($fila = $resultat->fetch_assoc()) {
    $dades[] = $fila;
}
?>
<div class="container-gran text-center">
    <h1>Llistat d'incidències assignades</h1>
        <tbody>
        <h3>Prioritat Alta</h3>

        <table class="table">
            <thead>
                    <tr>
                        <th>ID Incidència</th>
                        <th>Descripció </th>
                        <th>Departament </th>
                        <th> </th>
                    </tr>
            </thead>
        <?php foreach ($dades as $fila): ?>
        <?php if ($fila['prioritat'] == 'Alta'): ?>
            <tr class="table-danger">
                <td rowspan="2"><?= $fila["idIncidencia"] ?></td>
                <td rowspan="2"> <?= $fila["descripcio"] ?> </td>
                <td rowspan="2"><?= $fila["nom"] ?> </td>
                <td> <a href="llistar_inci_id.php?idIncidencia=<?php echo $fila["idIncidencia"]; ?>"> LListar Actuacions</a></td>
            </tr>
            <tr class="table-danger">
                <td> <a href="crear_act.php?idIncidencia=<?php echo $fila["idIncidencia"]; ?>&idTecnic=<?php echo $idTecnic?>">Crear Actuacio</a></td>
            </tr>
        <?php endif; ?>
        <?php endforeach; ?>
        </table>
        <h3>Prioritat Mitja</h3>

        <table class="table">
            <thead>
                    <tr>
                        <th>ID Incidència</th>
                        <th>Descripció </th>
                        <th>Departament </th>
                        <th> </th>
                    </tr>
                    </thead>
        <?php foreach ($dades as $fila): ?>
        <?php if ($fila['prioritat'] == 'Mitja'): ?>
            <tr class="table-warning">
                <td rowspan="2"><?= $fila["idIncidencia"] ?></td>
                <td rowspan="2"> <?= $fila["descripcio"] ?> </td>
                <td rowspan="2"><?= $fila["nom"] ?> </td>
                <td> <a href="llistar_inci_id.php?idIncidencia=<?php echo $fila["idIncidencia"]; ?>"> LListar Actuacions</a></td>
            </tr>
            <tr class="table-warning">
                <td> <a href="crear_act.php?idIncidencia=<?php echo $fila["idIncidencia"]; ?>&idTecnic=<?php echo $idTecnic?>">Crear Actuacio</a></td>
            </tr>
        <?php endif; ?>
        <?php endforeach; ?>
        </table>
        <h3>Prioritat Baixa</h3>

        <table class="table">
            <thead>
                    <tr class="table">
                        <th>ID Incidència</th>
                        <th>Descripció </th>
                        <th>Departament </th>
                        <th> </th>
                    </tr>
                    </thead>
        <?php foreach ($dades as $fila): ?>
        <?php if ($fila['prioritat'] == 'Baixa'): ?>
            <tr class="table-info">
                <td rowspan="2"><?= $fila["idIncidencia"] ?></td>
                <td rowspan="2"> <?= $fila["descripcio"] ?> </td>
                <td rowspan="2"><?= $fila["nom"] ?> </td>
                <td> <a href="llistar_inci_id.php?idIncidencia=<?php echo $fila["idIncidencia"]; ?>"> LListar Actuacions</a></td>
            </tr>
            <tr class="table-info">
                <td> <a href="crear_act.php?idIncidencia=<?php echo $fila["idIncidencia"]; ?>&idTecnic=<?php echo $idTecnic?>">Crear Actuacio</a></td>
            </tr>
        <?php endif; ?>
        <?php endforeach; ?>
        </table>
        </tbody>
</div>

<?php $link = 'tecnics.php'; ?>
<?php include_once "footer.php"; ?>