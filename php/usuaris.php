<?php include_once "auth.php"?>
<?php include_once "header.php";?>
<?php include_once "connexio_mongo.php"?>

<?php

$mysqli = require_once 'connexio.php';
$sentencia = $mysqli->prepare("SELECT idDepartament, nom
FROM DEPARTAMENT
 ");
$sentencia->execute();

$resultat = $sentencia->get_result();
$dades = [];

while ($fila = $resultat->fetch_assoc()) {
    $dades[] = $fila;
}

?>
<style>
    textarea {
        resize: none;
    }
</style>
<div class="container">
    <div class="text-center">
        <h1>Registrar Incidència</h1>
        <form name="formRegInci" action="registrar_inci.php" method="POST" onsubmit="return validarRegInc()" >
            <div class="form-group">
                <label for="departament">Departament</label>
                <select name="departament" id="departament" name="departament">
                    <option value="" disabled selected> --Selecciona el departament -- </option>
                    <?php foreach ($dades as $fila): ?>
                    <option value="<?= $fila["idDepartament"] ?>"> <?= $fila["nom"]?> </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="descripcio">Descripció</label>
                <textarea placeholder="Descripció" class="form-control" name="descripcio" id="descripcio" rows="4" cols="30"  ></textarea>
            </div>
            <div class="form-group"><button class="btn btn-outline-primary">Registrar</button></div>
        </form>
    </div>
</div>
<hr>
<div class="container">
    <div class="text-center">
        <h1>Consultar estat Incidència</h1>

        <form action="llistar_inci_id.php" method="GET" name="consultar_Inc_id" onsubmit="return validarNumId()">
            <div class="form-group">
                <label for="idIncidencia">Número Incidència</label> <br>
                <textarea name="idIncidencia" placeholder="Indica el número de la teva Incidència" rows="1" cols="30"></textarea>
            </div>
            <div class="form-group"><button class="btn btn-outline-primary">Trobar</button></div>
        </form>
    <br>
                <p>O bé, pots consultar per departaments: </p>

    <form action="llistar_inci_dept.php" method="GET" name="consultar_Inc_dept" onsubmit="return validarDept()">
                <div class="form-group">
                    <label for="departament">Departament</label>
                    <select name="departament" id="departament">
                    <option value="" disabled selected> --Selecciona el departament -- </option>
                    <?php foreach ($dades as $fila): ?>
                    <option value="<?= $fila["idDepartament"] ?>"> <?= $fila["nom"]?> </option>
                    <?php endforeach; ?>
                    </select>
                </div>
            <div class="form-group"><button class="btn btn-outline-primary">Trobar</button></div>

            </form>
    </div>
</div>

<?php $link = 'index.php'; ?>
<?php include_once "footer.php"; ?>
