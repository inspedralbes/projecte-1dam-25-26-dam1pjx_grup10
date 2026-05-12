<?php

session_start();

/*

    Array temporal d'usuaris.

    Més endavant això es podria substituir per una base de dades.

*/

$usuaris = array(

    "usuari" => "usuari",

    "josep" => "josep",

    "izan" => "izan"

);

$error = "";

/*

    Si ja està autenticat, el redirigim directament

*/

if (isset($_SESSION["usuari"])) {

    header("Location: login_success.php");

    exit();

}

/*

    Quan s'envia el formulari

*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuari = $_POST["usuari"];

    $password = $_POST["password"];

    /*

        Comprovem si l'usuari existeix i si la contrasenya coincideix

    */

    if (isset($usuaris[$usuari]) && $usuaris[$usuari] == $password) {

        $_SESSION["usuari"] = $usuari;

        header("Location: index.php");

        exit();

    } else {

        $error = "Usuari o contrasenya incorrectes";

    }

}

?>
<!DOCTYPE html>

<html lang="ca">

<head>

    <meta charset="UTF-8">

    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>

    <div class="container-gran centrat_mig">

    <h1>Inici de sessió</h1>
    <p> <b>Registre d'incidències</b></p>

    <?php

    if ($error != "") {

        echo "<p style='color:red;'>$error</p>";

    }

    ?>

    <form method="POST" action="login.php">

        <label>Usuari:</label><br>

        <input type="text" name="usuari" required><br><br>

        <label>Contrasenya:</label><br>

        <input type="password" name="password" required><br><br>

        <button class="btn btn-outline-primary" type="submit">Entrar</button>

    </form>
</div>
</body>

</html>
