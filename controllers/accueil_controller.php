<?php

session_start();

// Sécurité : on vérifie si l'utilisateur est connecté
if (!isset($_SESSION['compte_id'])) {
    header("Location: connexion_controller.php");
    exit();
}

// Tu récupères les données de session
$compte_id = $_SESSION['compte_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . "/../models/db_connect.php";
require_once __DIR__ . "/../models/openfooddata_connect.php";
require_once __DIR__ . "/../models/accueil_model.php";
$alertes = urgent();

// models
require_once __DIR__ . "/../models/recette_model.php";
require_once __DIR__ . "/../models/favoris_model.php";

// traitement
$recettes = list_recette();

// views
require_once __DIR__ . "/../views/accueil_view.php";

