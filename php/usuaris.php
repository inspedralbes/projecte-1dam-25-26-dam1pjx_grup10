<?php include_once "header.php"; ?>
<div class="row">
    <div class="col-12">
        <h1>Registar Incidència</h1>
        <form action="registrar_inci.php" method="POST">
            <div class="form-group">
                <label for="departament">Departament</label>
                <select name="departament" id="departament" required>
                    <option value="" selected disabled>-- Selecciona departament --</option>
                    <option value="1">Informàtica</option>
                    <option value="2">Català</option>
                    <option value="3">Castellà</option>
                    <option value="4">Matemàtiques</option>
                </select>
            </div>
            <div class="form-group">
                <label for="descripcio">Descripció</label>
                <textarea placeholder="Descripció" class="form-control" name="descripcio" id="descripcio" cols="30" rows="10" required></textarea>
            </div>
            <div class="form-group"><button class="btn btn-success">Registrar</button></div>
        </form>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12">
        <h1>Consultar estat Incidència</h1>


        <form action="llistar_inci_id.php" method="GET">
            <div class="form-group">
                <label for="idIncidencia">Número Incidència</label> <br>
                <textarea name="idIncidencia" placeholder="Indica el número de la teva Incidència"></textarea>
            </div>
            <div class="form-group"><button class="btn btn-success">Trobar</button></div>
        </form>
    <br>
                <p>O bé, pots consultar per departaments: </p>

    <form action="llistar_inci_dept.php" method="GET">
                <div class="form-group">
                    <label for="departament">Departament</label>
                    <select name="departament" id="departament">
                        <option value="" disabled selected>-- Selecciona departament --</option>
                        <option value="1">Informàtica</option>
                        <option value="2">Català</option>
                        <option value="3">Castellá</option>
                        <option value="4">Matemàtiques</option>
                    </select>
                </div>
            <div class="form-group"><button class="btn btn-success">Trobar</button></div>

            </form>
    </div>
</div>
<?php include_once "footer.php"; ?>
