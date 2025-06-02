<?php
session_start();
// Tu récupères les données de session
$compte_id = $_SESSION['compte_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];


// model

//var_dump($_POST);
require_once __DIR__ . "/../models/favoris_model.php";
require_once __DIR__ . "/../models/recette_model.php";

// traitement
$recettes = get_favoris_by_compte_id($compte_id);

// view
require_once __DIR__ . "/../views/mon_profil_view.php";