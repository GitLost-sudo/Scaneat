<?php

$id = $_GET['id'] ?? null;

// model
require_once __DIR__.'/../models/recette_model.php';

$recette = get_recette_by_id($id);

// view
require_once __DIR__.'/../views/details_recette_view.php';