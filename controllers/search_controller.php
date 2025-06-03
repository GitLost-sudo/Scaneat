<?php

session_start();
$compte_id = $_SESSION['compte_id'];

// model
require_once __DIR__.'/../models/recette_model.php';
require_once __DIR__.'/../models/favoris_model.php';

$vegetarien = '';
$vegan = '';
$sans_gluten = '';
$sans_lactose = '';
$halal = '';

$searched_text = $_POST['search'] ?? '';

$recettes = search_recette($searched_text, $compte_id);

// view
require_once __DIR__.'/../views/liste_recette_view.php';