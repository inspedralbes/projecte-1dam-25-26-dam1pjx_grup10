<?php include_once "header.php"; ?>

<?php
$mysqli = include_once "connexio.php";
$idIncidencia = intval($_GET["idIncidencia"]);
$prioritat = strval($_GET["prioritat"]);
$tipologia = intval($_GET["tipologia"]);
$tecnic = intval($_GET["tecnic"]);


$sentencia = $mysqli->prepare("UPDATE INCIDENCIA SET
prioritat = ?, tipologia = ?, tecnic = ?
WHERE idIncidencia = $idIncidencia");
$sentencia->bind_param("sii", $prioritat, $tipologia, $tecnic);
$sentencia->execute();
?>

<h2>Actualització correcte</h2>

<?php include_once "footer.php"; ?>