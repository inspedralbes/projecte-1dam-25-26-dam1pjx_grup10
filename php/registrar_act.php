<?php
$mysqli = require_once 'connexio.php';
$temps = $_POST["temps_trigat"];
$descripcio = $_POST["descripcio"];
$finalizat = isset($_POST["finalizat"]) ? 1 : 0;
$visible = isset($_POST["visible"]) ? 1 : 0;
$incidencia = intval($_POST["idIncidencia"]);
$sentencia = $mysqli->prepare("INSERT INTO ACTUACIO
(incidencia, temps, descripcio, visible)
VALUES
(?, ?, ?, ?)");
if ($finalizat == 1) {
    $update = $mysqli->prepare("UPDATE INCIDENCIA SET data_fi = NOW() WHERE idIncidencia = ?");
    $update->bind_param("i", $incidencia);
    $update->execute();
}
$sentencia->bind_param("iisi", $incidencia,$temps, $descripcio, $visible);
$sentencia->execute();
