<?php


// Inclusion du modèle
require_once __DIR__ . '/../models/ajout_produit_frigo_model.php';

// Gestion d'erreur
$error = null;

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Vérification des paramètres requis
        if (!isset($_POST['nom']) || trim($_POST['nom']) === '') {
            throw new Exception("Le nom du produit est obligatoire.");
        }

        // Appel à la fonction d'ajout
        ajouter_produit_manuel(
            $_POST['nom'],
            $_POST['quantite'] ?? null,
            $_POST['date_peremption'] ?? null,
            $_POST['categorie'] ?? null
        );
        // Message de succès
        $success = "Produit ajouté avec succès !";
        // Redirection après ajout

        
    }
} catch (Throwable $e) {
    // En cas d'erreur, stocke le message pour affichage
    $error = $e->getMessage();
}

// Affichage de la vue avec ou sans erreur
require_once __DIR__ . '/../views/frigo_view.php';