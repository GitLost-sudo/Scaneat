<?php
session_start();

// Tu récupères les données de session
$compte_id = $_SESSION['compte_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];


// Inclusion du modèle
require_once __DIR__ . '/../models/supprimer_produit_frigo_model.php';
require_once __DIR__ . '/../models/frigo_model.php';

// Gestion d'erreur
$error = null;


    
        
        $frigo_id = $_GET['id'];
        // Appel à la fonction d'ajout
       supprimer_produit_frigo($frigo_id);
        $success = "Produit supprimé avec succès !";
        // Redirection après ajout

        
    /*
} catch (Throwable $e) {
    // En cas d'erreur, stocke le message pour affichage
    $error = $e->getMessage();
}*/

$produits = frigo($compte_id);

// Affichage de la vue avec ou sans erreur
require_once __DIR__ . '/../views/frigo_view.php'; 