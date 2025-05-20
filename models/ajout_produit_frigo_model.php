<?php
require_once __DIR__."/openfooddata_connect.php";
function ajouter_produit_manuel($nom, $date_peremption, $quantite, $categorie) {
    global $db;
    $date_peremption = (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date_peremption)) ? $date_peremption : null;
    $quantite = is_numeric($quantite) ? $quantite : null;

    $sql = "INSERT INTO frigo (nom, date_peremption, quantite, categorie) 
            VALUES (:nom, :date_peremption, :quantite, :categorie)";
    $query = $db->prepare($sql);
    $query->execute([
        ':nom' => $nom,
        ':date_peremption' => $date_peremption,
        ':quantite' => $quantite,
        ':categorie' => $categorie,
       
    ]);
}

