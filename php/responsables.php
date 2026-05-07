<?php include_once("header.php"); ?>
<?php include_once "connexio_mongo.php"?>
<div class="container">
    <div class="text-center">
        <h1>Hola, Responsable: Gestió  d'Incidències</h1>
            <div class="form-group">
                <h3>Incidències no resoltes</h3>
                <a href="./incidencies_nr.php" class="btn btn-outline-primary">Veure</a>
            </div>
            <div class="form-group">
                <h3>Incidències pendents d'assignar</h3>
                <a href="./incidencies_pa.php" class="btn btn-outline-primary">Veure</a>
            </div>
        <br>
        <br>
            <div class="form-group">
                <a href="./informe_tecnics.php" class="btn btn-outline-primary">Informe de Tècnics</a>
                <a href="./consum_departament.php" class="btn btn-outline-primary">Consum per Departaments</a>
            </div>
    </div>
</div>
<br>

<?php $link = 'index.php'; ?>
<?php include_once("footer.php"); ?>