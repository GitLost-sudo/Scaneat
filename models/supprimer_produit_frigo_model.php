<?php

require_once __DIR__."/db_connect.php";
function supprimer_produit_frigo($frigo_id) {
    global $db;
    $sql = "DELETE FROM frigo WHERE frigo_id = :frigo_id";
    $query = $db->prepare($sql);
    $query->execute([ ':frigo_id' => $frigo_id ]);
};