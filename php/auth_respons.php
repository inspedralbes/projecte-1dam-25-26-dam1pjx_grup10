<?php

session_start();

if (!($_SESSION["rols"] == "admin")) {

    header("Location: login.php");

    exit();

}

?>