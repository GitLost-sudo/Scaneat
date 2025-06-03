<?php

require_once __DIR__."/db_connect.php";
function supprimer_produit_frigo($compte_id) {
    global $db;
    $sql = "DELETE FROM frigo WHERE compte_id = :compte_id";
    $query = $db->prepare($sql);
    $query->execute([ ':compte_id' => $compte_id ]);
};