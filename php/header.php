<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestió d'incidències.</title>
    <link rel="icon" href="./img/favicon.png" type="img/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>


    <div class="container-gran">
        <header class="py-3 mb-4">
            <a href="/" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none">
                <svg class="bi me-2" width="40" height="32" aria-hidden="true"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-2">Aplicació de gestió d'Incidències informàtiques</span>
            </a>
            <div class="border-top pt-2">
                <ul class="nav nav-pills justify-content-center">
                    <li class="nav-item"><a href="./index.php" class="nav-link">Inici</a></li>
                    <?php if ($_SESSION["rols"] == "usuari" || $_SESSION["rols"] == "admin" ||$_SESSION["rols"] == "tecnic" ): ?>
                    <li class="nav-item"><a href="./usuaris.php" class="nav-link">Usuari</a></li>
                    <?php endif; ?>
                    <?php if ($_SESSION["rols"] == "admin" ||$_SESSION["rols"] == "tecnic" ): ?>
                    <li class="nav-item"><a href="./tecnics.php" class="nav-link">Tècnic</a></li>
                    <?php endif; ?>
                    <?php if ($_SESSION["rols"] == "admin"): ?>
                    <li class="nav-item"><a href="./responsables.php" class="nav-link">Responsable</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a href="./logout.php" class="nav-link"><img src="./img/logout_back-removebg-preview.png" alt="Tancar sessio" height="30px"></a></li>
                </ul>
            </div>
        </header>
    </div>
    <main class="container-fluid">

