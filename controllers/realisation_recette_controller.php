<?php

// model
require_once __DIR__.'/../models/recette_model.php';
// IL FAUDRA AUSSI MODIFIER LES PRODUIT DANS LE FRIGO

$id = $_POST['id'] ?? null;

$recette = get_recette_by_id($id);

$recette['realisee'] = true;

// view
require_once __DIR__.'/../views/details_recette_view.php';