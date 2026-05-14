<?php include_once "auth_respons.php"?>
<?php include_once "header.php"?>
<?php include_once "connexio_mongo.php"?>
<?php
    $filtre_data   = $_GET['data']   ?? '';
    $filtre_usuari = $_GET['usuari'] ?? '';
    $filtre_pagina = $_GET['pagina'] ?? '';

    $match_base = [];

    if ($filtre_data !== '') {
        $match_base['data_inici_sessio'] = ['$regex' => '^' . $filtre_data];
    }
    if ($filtre_usuari !== '') {
        $match_base['usuari_id'] = ['$regex' => $filtre_usuari, '$options' => 'i'];
    }
    if ($filtre_pagina !== '') {
        $match_base['url'] = ['$regex' => $filtre_pagina, '$options' => 'i'];
    }
?>
<div class="container-mitja">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-filter"></i> Filtres d'estadístiques</h6>
            </div>
            <div class="card-body">
                <form method="GET" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Data</label>
                        <input type="date" name="data" class="form-control" value="">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Usuari</label>
                        <input type="text" name="usuari" class="form-control" placeholder="Nom d'usuari" value="">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Pàgina</label>
                        <input type="text" name="pagina" class="form-control" placeholder="/index.php" value="">
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100 fw-bold">Filtrar</button>
                        <button type="button" onclick="location.href='estadistiques.php'" class="btn btn-outline-secondary w-100">Netejar</button>
                    </div>
                </form>
            </div>
</div>
<?php if (!empty($match_base)): ?>
    <div class="container-mitja">
    <?php
        $pipeline_resum = [
            ['$match' => $match_base],
            ['$group' => ['_id' => 0, 'total' => ['$sum' => 1]]],
            ['$project' => ['_id' => 0, 'total' => 1]]
        ];

        $res_resum = $collection->aggregate($pipeline_resum);
        $total_filtrat = 0;
        foreach ($res_resum as $doc) {
            $total_filtrat = $doc['total'];
        }
        ?>

        <h2>Total d'accessos amb els filtres aplicats</h2>
        <div class="">
            <strong><i class="bi bi-funnel-fill"></i> Resultats filtrats per:</strong>
            <?= $filtre_data   !== '' ? " Data: <b>$filtre_data</b>"     : "" ?>
            <?= $filtre_usuari !== '' ? " Usuari: <b>$filtre_usuari</b>" : "" ?>
            <?= $filtre_pagina !== '' ? " Pàgina: <b>$filtre_pagina</b>" : "" ?>
        </div>
        <table class="table">
            <thead>
                <tr><th>Total Accessos</th></tr>
            </thead>
            <tbody>
                <tr><td><?= $total_filtrat ?></td></tr>
            </tbody>
        </table>
    </div>
<?php endif; ?>
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
                '$sort' => ['total' => -1]
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
            '_id' => '$usuari_id',
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
            'usuari_id' => '$_id',
            'total' => 1
        ]
    ]
];
$resultados = $collection->aggregate($pipeline_usumesact);
?>
<table class="table">
    <thead>
    <tr>
        <th>Usuaris més actius</th>
        <th>Total Visites</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($resultados as $document): ?>
        <tr>
            <?php if ($document["usuari_id"] != null): ?>
            <td><?php echo $document->usuari_id; ?></td>
            <td><?= $document["total"] ?></td>
            <?php endif; ?>
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
        'url' => ['$regex' => 'login.php']
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
