<?php

session_start();
// Tu récupères les données de session
$compte_id = $_SESSION['compte_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];

// model
require_once __DIR__.'/../models/recette_model.php';

$vegetarien = '';
$vegan = '';
$sans_gluten = '';
$sans_lactose = '';
$halal = '';

$searched_text = $_POST['search'] ?? '';

$recettes = search_recette($searched_text, $compte_id);

// view
require_once __DIR__.'/../views/liste_recette_view.php';