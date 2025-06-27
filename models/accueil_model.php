<?php

require_once __DIR__."/openfooddata_connect.php";
function urgent($compte_id) {
    global $db;
    $sql = "
        SELECT frigo.nom, frigo.date_peremption, frigo.categorie
        FROM frigo 
        WHERE 
            compte_id = :compte_id
            AND DATEDIFF(frigo.date_peremption, CURDATE()) <= 4
            AND DATEDIFF(frigo.date_peremption, CURDATE()) >= 0
        ORDER BY frigo.date_peremption ASC;
    ";
    $query = $db->prepare($sql);
    $query->execute(['compte_id' => $compte_id]);
    return $query->fetchAll();
}
