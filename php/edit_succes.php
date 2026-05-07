<?php include_once "header.php"; ?>
<?php include_once "connexio_mongo.php"?>
<?php
$mysqli = include_once "connexio.php";
$idIncidencia = intval($_GET["idIncidencia"]);
$prioritat = strval($_GET["prioritat"]);
$tipologia = intval($_GET["tipologia"]);
$tecnic = intval($_GET["idTecnic"]);


$sentencia = $mysqli->prepare("UPDATE INCIDENCIA SET
prioritat = ?, tipologia = ?, tecnic = ?
WHERE idIncidencia = $idIncidencia");
$sentencia->bind_param("sii", $prioritat, $tipologia, $tecnic);
$sentencia->execute();
?>
<div class="container text-center">
<h2>Actualització correcte</h2>
</div>
<?php $link = 'incidencies_pa.php'; ?>
<?php include_once "footer.php"; ?>