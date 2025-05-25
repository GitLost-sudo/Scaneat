<?php
$email_utilisateur_connecté = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
var_dump($_POST);

//On démarre une nouvelle session
session_start();
$id_session = session_id();


// model

//var_dump($_POST);
require_once __DIR__ . "/../models/compte_model.php";
require_once __DIR__ . "/../models/recette_model.php";

// traitement


// view

require_once __DIR__ . "/../views/mon_profil_view.php";