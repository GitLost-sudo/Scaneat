<?php
// Toutes les fonctions relatives à l'appel de la table compte dans la base de données
require_once __DIR__ . '/../models/db_connect.php';

function get_favoris_by_compte_id($compte_id) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM favoris WHERE compte_id = ?");
    $stmt->execute([$compte_id]);
    $favoris = $stmt->fetchAll();
    
    $recettes = [];
    foreach ($favoris as $favori) {
        $recette = get_recette_by_id($favori['recette_id']);
        if ($recette) {
            $recettes[] = $recette;
        }
    }
    
    return $recettes;
}

function ajouter_favoris($compte_id, $recette_id) {
    // Vérification si le favori existe déjà
    if (is_favori($compte_id, $recette_id)) {
        return false; // Le favori existe déjà
    }
    global $db;
    $stmt = $db->prepare("INSERT INTO favoris (compte_id, recette_id) VALUES (?, ?)");
    return $stmt->execute([$compte_id, intval($recette_id)]);
}

function retirer_favoris($compte_id, $recette_id) {
    global $db;
    $stmt = $db->prepare("DELETE FROM favoris WHERE compte_id = ? AND recette_id = ?");
    return $stmt->execute([$compte_id, intval($recette_id)]);
}

function is_favori($compte_id, $recette_id) {
    global $db;
    $stmt = $db->prepare("SELECT COUNT(*) FROM favoris WHERE compte_id = ? AND recette_id = ?");
    $stmt->execute([$compte_id, intval($recette_id)]);
    return $stmt->fetchColumn() > 0;
}