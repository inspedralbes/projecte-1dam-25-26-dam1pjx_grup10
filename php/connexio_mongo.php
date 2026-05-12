<?php
require  'vendor/autoload.php';
$inicio = microtime(true);
$uri = "mongodb+srv://projecte-1dam-25-26-dam1pj10_user:mPG10BD_s@projecte-1dam-25-26-dam.u52motu.mongodb.net/";
$client = new MongoDB\Client($uri);
$collection = $client->REGISTRE->LOGS;
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$hora = date("Y-m-d H:i:s");
$metodo = $_SERVER['REQUEST_METHOD'] ?? 'UNKNOWN';
$url = (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$fin = microtime(true);
$tempsResposta = round(($fin - $inicio) * 1000, 2);
$collection->insertOne([
    'url' => $url,
    'metode' => $metodo,
    'usuari_id' => 'Desconegut',
    'data_inici_sessio' => $hora,
    'navegador' => $_SERVER['HTTP_USER_AGENT'],
    'ip' => $ip,
    'temps_resposta_ms'=> $tempsResposta
]);



