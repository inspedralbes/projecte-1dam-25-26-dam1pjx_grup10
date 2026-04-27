<?php
$mysqli = require_once 'connexio.php';
$departament = intval($_POST["departament"]);
$descripcio = $_POST["descripcio"];
$sentencia = $mysqli->prepare("INSERT INTO INCIDENCIA
(departament, descripcio)
VALUES
(?, ?)");
$sentencia->bind_param("is", $departament, $descripcio);
$sentencia->execute();
//header("Location: llistar_inci_id.php");
//TODO: Missatge que mostri exit del registre


