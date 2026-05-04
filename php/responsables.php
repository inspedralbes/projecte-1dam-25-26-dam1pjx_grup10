<?php include_once("header.php"); ?>
<div class="row">
    <div class="col-12">
        <h1>Hola, Responsable: Gestió  d'Incidències</h1>
            <div class="form-group">
                <h3>Incidències no resoltes</h3>
                <button onclick="location.href='./incidencies_nr.php'">Veure</button>
            </div>
            <div class="form-group">
                <h3>Incidències pendents d'assignar</h3>
                <button onclick="location.href='./incidencies_pa.php'">Veure</button>
            </div>
        <br>
        <br>
            <div class="form-group">
                <button onclick="location.href='./informe_tecnics.php'">Informe de Tècnics</button>
                <button onclick="location.href='./consum_departament.php'">Consum per Departaments</button>
            </div>
    </div>
</div>
<br>

<?php $link = 'index.php'; ?>
<?php include_once("footer.php"); ?>