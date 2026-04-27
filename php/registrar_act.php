<?php
$mysqli = require_once 'connexio.php';;
$temps = $_POST["temps_trigat"];
$descripcio = $_POST["descripcio"];
$finalizat = intval($_POST["finalizat"]);
$visible = intval($_POST["visible"]);
//$incidencia = $_Post["incidencia"];
$sentencia = $mysqli->prepare("INSERT INTO ACTUACIO
(temps, descripcio, visible)
VALUES
(?, ?, ?)");
$sentencia->bind_param("isi", $temps, $descripcio, $visible);
$sentencia->execute();
