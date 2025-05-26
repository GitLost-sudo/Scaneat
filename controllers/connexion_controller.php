<?php
session_start();

// Tu récupères les données de session
$compte_id = $_SESSION['compte_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];

//model

require_once __DIR__.'/../models/connexion_model.php';


//view
require_once __DIR__.'/../views/connexion.php';
