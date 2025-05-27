<?php

session_start();
echo "compte_id: " . $_SESSION['compte_id'];

// Tu récupères les données de session
$compte_id = $_SESSION['compte_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];

require_once "../models/frigo_model.php";

// Vérifie que compte_id est bien dans la session
if (isset($_SESSION['compte_id'])) {
    $compte_id = $_SESSION['compte_id'];
    $produits = frigo($compte_id);
} else {
    $produits = []; // ou redirige vers connexion
    $error = "Utilisateur non connecté.";
}

require_once "../views/frigo_view.php";