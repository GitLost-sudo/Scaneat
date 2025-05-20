<?php

// model
require_once __DIR__.'/../models/recette_model.php';

$id = $_GET['id'] ?? null;

$recette = get_recette_by_id($id);

$recette['realisee'] = false;

// view
require_once __DIR__.'/../views/details_recette_view.php';