<?php

require_once __DIR__."/db_connect.php";
function supprimer_produit_frigo($produit_id) {
    global $db;
    $sql = "DELETE FROM `frigo` WHERE `produit_id` = :produit_id";
    $query = $db->prepare($sql);
    $query->execute(array(
        ":produit_id" => $produit_id
    ));

};