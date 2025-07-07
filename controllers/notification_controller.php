<?php
session_start();
require_once __DIR__ . '/../models/accueil_model.php';

header('Content-Type: application/json');

if (!isset($_SESSION['compte_id'])) {
    echo json_encode([]);
    exit;
}

$compte_id = $_SESSION['compte_id'];
$produits = urgent($compte_id); // Utilisation directe

// On peut ajouter diff_jours si besoin
$today = new DateTime();
$today->setTime(0, 0, 0);
foreach ($produits as &$produit) {
    $date_peremption = new DateTime($produit['date_peremption']);
    $produit['diff_jours'] = $today->diff($date_peremption)->days;
}
unset($produit);

echo json_encode($produits);