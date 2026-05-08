<?php include_once "header.php"?>
<?php include_once "connexio_mongo.php"?>
<?php
echo "<div class='container'>\n";
echo "<h2> Accesos per dia</h2>\n";
$pipeline_dias = [
    [
        '$match' => [
            'data_inici_sessio' => [ '$regex' => ' ' ]
        ]
    ],
    ['$group' => [
        '_id' => [
            '$substr' => [ '$data_inici_sessio', 0, 10]
        ],
        'total' => ['$sum' => 1]
        ]
    ],
    [
        '$sort' => ['_id' => -1]
    ],
    [
        '$project' => [
        '_id' => 0,
        'data_inici_sessio' => '$_id',
        'total' => 1
    ]
    ]
];
$resultados = $collection->aggregate($pipeline_dias);
foreach ($resultados as $document) {
    echo "Dia: " . $document->data_inici_sessio ."<br>" . "Total: " . $document->total . "<br>";
}
echo "</div>";
echo "<div class='container'>\n";
echo "<h2> Pagines mes visitades</h2>\n";
$pipeline_pagmesvisit = [
    [
        '$group' => [
            '_id' => '$url',
            'total' => ['$sum' => 1]
        ]
    ],
    [
        '$sort' => [
            'total' => -1]
    ],
    [
        '$limit' => 5
    ],
    [
        '$project' => [
            '_id' => 0,
            'url' => '$_id',
            'total' => 1]
    ]
];
$resultados = $collection->aggregate($pipeline_pagmesvisit);
foreach ($resultados as $document) {
    echo "URL: " . $document->url ."<br>" . "Total: " . $document->total . "<br>";
}
echo "</div>";
echo "<div class='container'>\n";
echo "<h2> Usuaris mes actius</h2>\n";
$pipeline_usumesact = [
    [
        '$group' => [
            '_id' => '$ip',
            'total' => ['$sum' => 1]
        ]
    ],
    [
        '$sort' => [
            'total' => -1
        ]
    ],
    [
        '$limit' => 5
    ],
    [
        '$project' => [
            '_id' => 0,
            'ip' => '$_id',
            'total' => 1
        ]
    ]
];
$resultados = $collection->aggregate($pipeline_usumesact);
foreach ($resultados as $document) {
    echo "IP: " . $document->ip ."<br>" . "Total: " . $document->total . "<br>";
}
echo "</div>";
echo "<div class='container'>\n";
echo "<h2> Accessos Totals</h2>\n";
$pipeline_totalaccess = [
    [
        '$match' => [
        'url' => ['$regex' => 'index.php']
        ]
    ],
    [
        '$group' => [
            '_id' => '$url',
            'total' => ['$sum' => 1]
        ]
    ],
    [
        '$project' => [
            '_id' => 0,
            'total' => 1
        ]
    ]
];
$resultados = $collection->aggregate($pipeline_totalaccess);
foreach ($resultados as $document) {
    echo "Total accesss: " . $document->total ."<br>";
}

?>

<?php include_once "footer.php"?>
