<?php
$email_utilisateur_connecté = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
var_dump($email);

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
