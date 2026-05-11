<?php include_once("header.php"); ?>
<?php include_once "connexio_mongo.php"?>
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

$ultimID = $mysqli->insert_id;

mail('a25josmonces@inspedralbes.cat, a25izagomdel@inspedralbes.cat', 'Nova incidència registrada',
"S'ha registrat una nova incidència del departament de " . $_POST['departament'] . "\nDescripció:\n" . $_POST['descripcio']
);

?>

<div class="container-mitja text-center">
<h1>Incidència registrada correctament.</h1>
<p>L'ID de la teva incidència és <?php echo $ultimID ?> </p>
<a href="./index.php" class="btn btn-outline-primary">Finalitzar</a>
</div>
<?php $link = 'usuaris.php'; ?>
<?php include_once "footer.php"; ?>