<?php
$mysqli = require_once 'connexio.php';;
$temps_trigat = intval($_POST["temps_trigat"]);
$descripcio = $_POST["descripcio"];
$finalizat = intval($_POST["finalizat"]);
$visible = intval($_POST["visible"]);
//$incidencia = $_Post["incidencia"];
$sentencia = $mysqli->prepare("INSERT INTO ACTUACIO
(temps_trigat, descripcio, finalizat, visible)
VALUES
(?, ?, ?, ?)");
$sentencia->bind_param("isii", $temps_trigat, $descripcio, $finalizat, $visible);
$sentencia->execute();
header("Location: llistar_inci.php");
