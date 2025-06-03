<?php

session_start();
$compte_id = $_SESSION['compte_id'] ?? null;

// model
require_once __DIR__.'/../models/recette_model.php';
require_once __DIR__.'/../models/favoris_model.php';

$id = $_GET['id'] ?? null;

$recette = get_recette_by_id($id, $compte_id);

$recette['realisee'] = false;

// view
require_once __DIR__.'/../views/details_recette_view.php';