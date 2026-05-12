<?php include_once "auth.php"?>
<?php include_once "header.php"?>
<?php include_once "connexio_mongo.php"?>


<div class="container text-center">
    <h2> Benvigut a l'aplicatiu de gestió d'incidències </h2>

    <h4> Has iniciat sessió, entra a la teva pàgina: </h4>

        <ul class="list-group list-group-flush">
            <?php if ($_SESSION["rols"] == "usuari" || $_SESSION["rols"] == "admin" ||$_SESSION["rols"] == "tecnic" ): ?>
            <li class="list-group-item"><a href="./usuaris.php" class="nav-link">Usuari</a></li>
            <?php endif; ?>
            <?php if ($_SESSION["rols"] == "admin" ||$_SESSION["rols"] == "tecnic" ): ?>
            <li class="list-group-item"><a href="./tecnics.php" class="nav-link">Tècnic</a></li>
            <?php endif; ?>
            <?php if ($_SESSION["rols"] == "admin"): ?>
            <li class="list-group-item"><a href="./responsables.php" class="nav-link">Responsable</a></li>
            <?php endif; ?>
        </ul>
</div>



<?php $link = 'index.php'; ?>
<?php include_once "footer.php"?>
