<?php

require_once __DIR__."/openfooddata_connect.php";
function frigo($compte_id) {
    global $db;
    $sql = "SELECT * FROM frigo WHERE compte_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$compte_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function have_any_products($compte_id) {
    global $db;
    $sql = "SELECT COUNT(*) FROM frigo WHERE compte_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$compte_id]);
    return $stmt->fetchColumn() > 0;
}