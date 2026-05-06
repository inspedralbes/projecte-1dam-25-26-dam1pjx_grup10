<?php
require __DIR__ . '/../vendor/autoload.php';
$uri = getenv('mongodb+srv://projecte-1dam-25-26-dam1pj10_user:mPG10BD_s@projecte-1dam-25-26-dam.u52motu.mongodb.net/') ?: throw new RuntimeException(
    'Set the MONGODB_URI environment variable to your Atlas URI',
);
$client = new MongoDB\Client($uri);
$collection = $client->LOGS->LOGS;
$results = $collection->insertOne(url: ["google.es"], metode: "post", usuari_id: "Usuari", data_inici_sessio: new Date(), navegador: "Firefox", ip: "192.168.123.54", temps_resposta_ms: 123);

