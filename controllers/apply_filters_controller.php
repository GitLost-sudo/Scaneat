<?php

// controllers
$vegetarien = isset($_POST['vegetarien']) ? true : false;
$vegan = isset($_POST['vegan']) ? true : false;
$sans_gluten = isset($_POST['sans_gluten']) ? true : false;
$sans_lactose = isset($_POST['sans_lactose']) ? true : false;
$halal = isset($_POST['halal']) ? true : false;

// models
require_once __DIR__.'/../models/recette_model.php';

// views
require_once __DIR__.'/../views/liste_recette_view.php';