<?php include_once "auth_respons.php"?>
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
?>
<table class="table">
    <thead>
    <tr>
        <th>Data</th>
        <th>Visites</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($resultados as $document): ?>
        <tr>
            <td><?= $document["data_inici_sessio"] ?></td>
            <td><?= $document["total"] ?></td>
        </tr>

    <?php endforeach; ?>
    </tbody>
</table>
</div>
<div class='container'>
    <h2>Accessos per dia</h2>
    <iframe class="container" style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);"
            width="640"
            height="480"
            src="https://charts.mongodb.com/charts-project-0-japdbiq/embed/charts?id=f2f7e522-5af0-4577-8734-7212448b77dc&maxDataAge=14400&theme=light&autoRefresh=true"></iframe>
</div>
<?php
echo "<div class='container'>\n";
echo "<h2> Pàgines més visitades</h2>\n";
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
            'url' => [
                '$replaceOne' => [
                    'input' => [
                        '$arrayElemAt' => [
                            ['$split' => ['$_id', '/']],
                            -1
                        ]
                    ],
                    'find' => '.php',
                    'replacement' => ''
                ]
            ],
            'total' => 1
        ]
    ]
];
$resultados = $collection->aggregate($pipeline_pagmesvisit);
?>
<table class="table">
    <thead>
    <tr>
        <th>Pagina</th>
        <th>Visites</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($resultados as $document): ?>
        <tr>
            <td><?= $document["url"] ?></td>
            <td><?= $document["total"] ?></td>
        </tr>

    <?php endforeach; ?>
    </tbody>
</table>
</div>
<div class='container' style="text-align: center;">
    <h2>Pàgines més Visitades</h2>
    <iframe
        class="container"
        style="background: #FFFFFF;border: none;border-radius: 2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);"
        width="640"
        height="480"
        src="https://charts.mongodb.com/charts-project-0-japdbiq/embed/charts?id=030043c8-a08d-453c-a09a-2da8143184ca&maxDataAge=14400&theme=light&autoRefresh=true"></iframe>
</div>
<?php
echo "<div class='container'>\n";
echo "<h2> Usuaris més actius</h2>\n";
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
?>
<table class="table">
    <thead>
    <tr>
        <th>IP</th>
        <th>Total Visites</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($resultados as $document): ?>
        <tr>
            <td><?php echo $document->ip; ?></td>
            <td><?= $document["total"] ?></td>
        </tr>

    <?php endforeach; ?>
    </tbody>
</table>
</div>
<div class='container' style="text-align: center;">
    <h2>Usuaris mes actius</h2>
    <iframe
        class="container"
        style="background: #FFFFFF;border: none;border-radius:2px;box-shadow: 0 2px 10px 0 rgba(70, 76, 79, .2);"
        width="640"
        height="480"
        src="https://charts.mongodb.com/charts-project-0-japdbiq/embed/charts?id=3800cfea-d34d-49a0-a146-fee6a8208098&maxDataAge=14400&theme=light&autoRefresh=true">
    </iframe>
</div>

<?php
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
            '_id' => null,
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
?>
<table class="table">
    <thead>
    <tr>
        <th>Total Access</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($resultados as $document): ?>
        <tr>
            <td><?= $document["total"] ?></td>
        </tr>

    <?php endforeach; ?>
    </tbody>
</table>
</div>

<?php $link = 'responsables.php' ?>
<?php include_once "footer.php"?>
