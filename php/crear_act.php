<?php include_once "header.php"; ?>
<?php $idIncidencia = intval($_GET['idIncidencia']); ?>
<div class="row">
    <div class="col-12">
        <h1>Registar Actuació</h1>
        <form action="registrar_act.php" method="POST">
            <div class="form-group">
                <label for="temps_trigat">Temps Trigat</label>
                <select name="temps_trigat" id="temps_trigat" required>
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
            <div class="form-group">
                <table>
                    <td>
                        <label for="descripcio">Descripción</label>
                        <textarea placeholder="Descripció" class="form-control" name="descripcio" id="descripcio" cols="30" rows="10" required></textarea>
                    </td>
                    <td>
                        <label for="visible">Visible per l'usuari</label>
                        <input type="checkbox" name="visible" id="visible" value="1">
                    </td>
                </table>
            </div>

            <div class="form-group">
                <label for="finalizat">Finalitzat?</label>
                <input type="checkbox" name="finalizat" id="yes" value="1">
            </div>
                <input type="hidden" name="idIncidencia" value="<?= $idIncidencia ?>">

                <div class="form-group"><button class="btn btn-success">Guardar</button></div>
            </div>
       </form>
    </div>
</div>
<?php include_once "footer.php"; ?>