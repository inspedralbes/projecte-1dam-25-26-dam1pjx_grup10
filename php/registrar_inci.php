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
?>

<div class="container-mitja text-center">
<h1>Incidència registrada correctament.</h1>
<p>L'ID de la teva incidència és <?php echo $ultimID ?> </p>
<a href="./index.php" class="btn btn-outline-primary">Finalitzar</a>
</div>

<?php $link = 'usuaris.php'; ?>
<?php include_once "footer.php"; ?>