<?php include_once("header.php"); ?>
<div class="row">
    <div class="col-12">
        <h1>Gestió  d'Incidències Com a Tecnic</h1>
        <form action="llistar_inci_tecnic.php" method="GET">
            <div class="form-group">
                <h3>Digues el teu id de Tecnic</h3>
                <label for="idTecnic"></label>
                <textarea class="form-control" name="idTecnic" id ="idTecnic" rows="3" cols="50" placeholder="Posa el numero"></textarea>
                <div class="form-group"><button class="btn btn-success">Trobar</button></div>
            </div>
        </form>
        <br>
    </div>
</div>
<br>

<?php $link = 'index.php'; ?>
<?php include_once("footer.php"); ?>
