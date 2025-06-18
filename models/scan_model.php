<?php

require_once __DIR__."/db_connect.php";
#model lié a la gestion des données des utilisateurs

//Create
function ajouter_produit_manuel($nom, $date_peremption, $quantite, $categorie) {
    global $db;
    $compte_id = $_SESSION['compte_id']; // j'ai ajouter le compte id ici cest important
    $date_peremption = (preg_match('/^\d{4}-\d{2}-\d{2}$/', $date_peremption)) ? $date_peremption : null;
    $quantite = is_numeric($quantite) ? $quantite : null;

    $sql = "INSERT INTO frigo (compte_id,nom, date_peremption, quantite, categorie) 
            VALUES (:compte_id,:nom, :date_peremption, :quantite, :categorie)";//on insere les info du produit ajouter manuellement au frigo 
    $query = $db->prepare($sql);
    $query->execute([
        ':compte_id'=>$compte_id,
        ':nom' => $nom,
        ':date_peremption' => $date_peremption,
        ':quantite' => $quantite,
        ':categorie' => $categorie,
    ]);
    

}