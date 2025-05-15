<?php

require_once __DIR__."/openfooddata_connect.php";
function urgent() {
    global $db;
    $sql ="SELECT 
    frigo.produit_id,
    openfooddata.nom,
    frigo.date_peremption
FROM 
    frigo 
JOIN 
    openfooddata  ON frigo.produit_id = openfooddata.produit_id
WHERE 
    DATEDIFF(frigo.date_peremption, CURDATE()) <= 4
    AND DATEDIFF(frigo.date_peremption, CURDATE()) >= 0
ORDER BY 
    frigo.date_peremption ASC;";
    $query = $db->prepare($sql);
    $query->execute();
    return $query->fetchAll();
    
}