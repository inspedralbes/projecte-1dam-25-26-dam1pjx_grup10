
<?php include_once "header.php"?>
<?php include_once "connexio_mongo.php"?>

<div class="container text-center">
    <h2> Benvigut a la pàgina principal de gestió d'incidències </h2>

    <h4> Qui ets? </h4>

        <ul class="list-group list-group-flush">
            <li class="list-group-item"><a href="./usuaris.php" class="nav-link">Usuari</a></li>
            <li class="list-group-item"><a href="./tecnics.php" class="nav-link">Tècnic</a></li>
            <li class="list-group-item"><a href="./responsables.php" class="nav-link">Responsable</a></li>
        </ul>
</div>



<?php $link = 'index.php'; ?>
<?php include_once "footer.php"?>
