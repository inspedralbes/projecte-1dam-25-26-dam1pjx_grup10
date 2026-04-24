<?php include_once "header.php"; ?>
<div class="row">
    <div class="col-12">
        <h1>Registrar videojuego</h1>
        <form action="registrar.php" method="POST">
            <div class="form-group">
                <label for="departament">Departament</label>
                <input placeholder="Departament" class="form-control" type="text" name="departament" id="departament" required>
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
