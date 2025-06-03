<?php

session_start();
$compte_id = $_SESSION['compte_id'];

// models
require_once __DIR__ . '/../models/favoris_model.php';

// traitement
$idMeal = $_GET['id'] ?? null;
if ($idMeal) {
    retirer_favoris($compte_id, $idMeal);
}

// Redirection ou gestion de l'erreur si l'ID de la recette n'est pas fourni
header("Location: ../controllers/liste_recette_controller.php");
exit();