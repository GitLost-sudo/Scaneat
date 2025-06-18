<?php
session_start();
// Tu récupères les données de session
$compte_id = $_SESSION['compte_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];

// model
require_once __DIR__.'/../models/recette_model.php';
require_once __DIR__.'/../models/supprimer_produit_frigo_model.php';
require_once __DIR__.'/../models/favoris_model.php';
// IL FAUDRA AUSSI MODIFIER LES PRODUIT DANS LE FRIGO

$id = $_POST['id'] ?? null;

$recette = get_recette_by_id($id, $compte_id);

// strIngredients$i
$ingredients = [];
for ($i = 1; $i <= 20; $i++) {
    $ingredient = $recette["strIngredient$i"];
    if (!empty($ingredient)) {
        supprimer_produit_frigo_by_nom($ingredient, $compte_id);
    }
}

$recette['realisee'] = true;

// view
require_once __DIR__.'/../views/details_recette_view.php';