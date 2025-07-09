<?php
session_start();

$compte_id = $_SESSION['compte_id'] ?? null;
$username = $_SESSION['username'] ?? '';
$email = $_SESSION['email'] ?? '';

require_once __DIR__ . '/../models/modifier_produit_frigo.php';
require_once __DIR__ . '/../models/frigo_model.php';

$error = null;
$success = null;

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Vérifie que l'ID du produit est bien passé via le formulaire
        if (!isset($_POST['frigo_id']) || !is_numeric($_POST['frigo_id'])) {
            throw new Exception("ID du produit manquant ou invalide.");
        }

        $frigo_id = (int)$_POST['frigo_id'];
        $date = $_POST['date_peremption'] ?? null;
        $quantite = $_POST['quantite'] ?? null;

        // Validation basique
        if (empty($date) || empty($quantite)) {
            throw new Exception("Tous les champs sont requis.");
        }

        // Appel de la fonction de modification
        if (modifier_produit_frigo($frigo_id, $date, $quantite)) {
            $_SESSION['success'] = "✅ Produit modifié avec succès.";
        } else {
            throw new Exception("❌ La modification a échoué.");
        }

        // Redirection vers la vue principale
        header("Location: ../controllers/frigo_controller.php");
        exit;
    }
} catch (Throwable $e) {
    $_SESSION['error'] = $e->getMessage();
    header("Location: ../views/frigo_view.php");
    exit;
}
$produits = frigo($compte_id);
