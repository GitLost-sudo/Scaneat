<?php
session_start();
// Tu récupères les données de session
$compte_id = $_SESSION['compte_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];

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

$categorie = $_POST['categorie'] ?? '';


// view
require_once __DIR__.'/../views/scanner_view.php';