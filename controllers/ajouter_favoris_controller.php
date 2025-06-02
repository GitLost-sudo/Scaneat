<?php

session_start();
$compte_id = $_SESSION['compte_id'];

// model
require_once __DIR__ . "/../models/favoris_model.php";

// traitement
$idMeal = $_GET['id'] ?? null;
if ($idMeal) {
    ajouter_favoris($compte_id, $idMeal);
    // Redirection vers la page de profil après l'ajout aux favoris
    header("Location: ../controllers/mon_profil_controller.php");
    exit();
}
else {
    // Redirection ou gestion de l'erreur si l'ID de la recette n'est pas fourni
    header("Location: ../controllers/liste_recette_controller.php");
    exit();
}