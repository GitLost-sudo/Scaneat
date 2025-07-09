<?php
require_once __DIR__."/openfooddata_connect.php";

function modifier_produit_frigo($frigo_id, $date_peremption, $quantite) {
    global $db;
    $compte_id = $_SESSION['compte_id']; // sécurité : ne modifie que les produits du compte connecté

    // Validation des données
    $date_peremption = (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date_peremption)) ? $date_peremption : null;
    $quantite = is_numeric($quantite) ? (int)$quantite : null;

    if (!$frigo_id || !$date_peremption || !$quantite || !$compte_id) {
        return false; // Échec si info manquante ou invalide
    }

    // Requête SQL de mise à jour
    $sql = "UPDATE frigo 
            SET date_peremption = :date_peremption, quantite = :quantite 
            WHERE frigo_id = :frigo_id AND compte_id = :compte_id";

    $query = $db->prepare($sql);
    return $query->execute([
        ':date_peremption' => $date_peremption,
        ':quantite' => $quantite,
        ':frigo_id' => $frigo_id,
        ':compte_id' => $compte_id
    ]);
}
?>