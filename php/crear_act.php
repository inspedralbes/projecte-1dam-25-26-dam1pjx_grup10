<?php include_once "auth_tecnic.php"?>
<?php include_once "header.php"; ?>
<?php include_once "connexio_mongo.php"?>
<?php $idIncidencia = intval($_GET['idIncidencia']); ?>
<div class="container">
    <div class="text-center">
        <h1>Registar Actuació</h1>
        <form action="registrar_act.php" method="POST" name="crear_Act" onsubmit="return validarCrearAct()">

                <label for="temps_trigat"><b>Temps Trigat</b></label>
                <select class="form-select text-center" name="temps_trigat" id="temps_trigat">
                    <option value="" selected disabled>-- Selecciona Temps Trigat --</option>
                    <option value="5">5min</option>
                    <option value="10">10min</option>
                    <option value="15">15min</option>
                    <option value="20">20min</option>
                    <option value="30">30min</option>
                    <option value="45">45min</option>
                    <option value="60">60min/1h</option>
                    <option value="75">75min/1:15h</option>
                    <option value="90">90min/1:30h</option>
                    <option value="105">105min/1:45h</option>
                    <option value="120">120min/2h</option>
                </select>



                <table class="text-center">
                    <tr>
                        <label for="descripcio"><b>Descripció</b></label>
                        <textarea placeholder="Descripció" class="form-control" name="descripcio" id="descripcio" cols="30" rows="10" ></textarea>
                    </tr>
                </table>

                <label for="visible">Visible per l'usuari</label>
                <input type="checkbox" name="visible" id="visible" value="1">
                <br>
                <label for="finalizat">Finalitzat?</label>
                <input type="checkbox" name="finalizat" id="yes" value="1">

                <input type="hidden" name="idIncidencia" value="<?= $idIncidencia ?>">

                <div class="form-group"><button class="btn btn-outline-primary">Guardar</button></div>
            </div>
       </form>
    </div>
</div>

<?php $link = 'llistar_inci_tecnic.php?idTecnic='.$_GET["idTecnic"]; ?>
<?php include_once "footer.php"; ?>