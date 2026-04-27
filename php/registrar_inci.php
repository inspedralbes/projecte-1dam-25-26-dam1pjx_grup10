<?php
$mysqli = require_once 'connexio.php';;
$departament = intval($_POST["departament"]);
$descripcio = $_POST["descripcio"];
$sentencia = $mysqli->prepare("INSERT INTO INCIDENCIA
(departament, descripcio)
VALUES
(?, ?)");
$sentencia->bind_param("ss", $departament, $descripcio);
$sentencia->execute();
header("Location: llistar_inci.php");
