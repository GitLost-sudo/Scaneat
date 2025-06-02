<?php
session_start();
// Tu récupères les données de session
$compte_id = $_SESSION['compte_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];

// models
require_once __DIR__.'/../models/recette_model.php';
require_once __DIR__.'/../models/favoris_model.php';

// controllers
$vegetarien = isset($_POST['vegetarien']) ? true : false;
$vegan = isset($_POST['vegan']) ? true : false;
$sans_gluten = isset($_POST['sans_gluten']) ? true : false;
$sans_lactose = isset($_POST['sans_lactose']) ? true : false;
$halal = isset($_POST['halal']) ? true : false;

$recettes = list_recette_by_filters($vegetarien, $vegan, $sans_gluten, $sans_lactose, $halal);

// views
require_once __DIR__.'/../views/liste_recette_view.php';