<?php

// model

$error = false; // undefined, false, 'not-found', ou autre
$product = [
    'name' => 'Nom du produit',
    'calories' => 100,
    'categories' => [
        ['id' => 1, 'name' => 'Fruits'],
        ['id' => 2, 'name' => 'Légumes'],
        ['id' => 3, 'name' => 'Viandes'],
    ],
];

// view
require_once __DIR__.'/../views/scanner_view.php';