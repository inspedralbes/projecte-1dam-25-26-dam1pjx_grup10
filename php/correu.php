<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to      = 'a25josmonces@inspedralbes.cat';
    $subject = 'Nova incidència';
    $message = "S'ha creat una nova incidència";
    $headers = 'From: web@exemple.com';
}
?>