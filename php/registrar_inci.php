<?php include_once("header.php"); ?>
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


<h1>Incidència registrada correctament.</h1>
<p>L'ID de la teva incidència és <?php echo $ultimID ?> </p>

<?php include_once "footer.php"; ?>