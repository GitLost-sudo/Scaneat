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