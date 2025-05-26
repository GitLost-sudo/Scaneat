<?php
session_start();
echo "compte_id: " . $_SESSION['compte_id'];
// Tu récupères les données de session
$compte_id = $_SESSION['compte_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];

// models
require_once __DIR__.'/../models/recette_model.php';

// controllers
$vegetarien = '';
$vegan = '';
$sans_gluten = '';
$sans_lactose = '';
$halal = '';

$recettes = list_recette_by_filters($vegetarien, $vegan, $sans_gluten, $sans_lactose, $halal);


// views
require_once __DIR__.'/../views/liste_recette_view.php';
