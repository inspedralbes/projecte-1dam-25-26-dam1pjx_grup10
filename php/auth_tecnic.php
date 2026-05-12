<?php

session_start();


if (!isset($_SESSION["usuari"])) {

    header("Location: login.php");

    exit();

}elseif (!($_SESSION["rols"] == "admin" || $_SESSION["rols"] == "tecnic")) {

    header("Location: login.php");

    exit();

}

?>