<?php include_once "header.php"; ?>
<div class="row">
    <div class="col-12">
        <h1>Registarr Incidencia</h1>
        <form action="registrar_inci.php" method="POST">
            <div class="form-group">
                <label for="departament">Departament</label>
                <select name="departament" id="departament" required>
                    <option value="1">Informàtica</option>
                    <option value="2">Català</option>
                    <option value="3">Castellá</option>
                    <option value="4">Matemàtiques</Matemàti></option>
                </select>
            </div>
            <div class="form-group">
                <label for="descripcio">Descripción</label>
                <textarea placeholder="Descripció" class="form-control" name="descripcio" id="descripcio" cols="30" rows="10" required></textarea>
            </div>
            <div class="form-group"><button class="btn btn-success">Guardar</button></div>
        </form>
    </div>
</div>
<?php include_once "footer.php"; ?>
