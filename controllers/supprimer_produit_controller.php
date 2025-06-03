<?php
require_once __DIR__ . '/../models/supprimer_produit_frigo_model.php';
$error = null;
if($_SERVER['REQUEST_METHOD']=='GET')
{
    //Guard
    if (!isset($_GET['compte_id']) || !is_numeric($_GET['compte_id'])) {
        throw new Exception("Paramètres invalides");
    }
    
    $compte_id = $_GET['compte_id'];
    supprimer_produit_frigo($compte_id);
    header('Location: ../views/frigo_view.php');
}
require_once __DIR__.'/../views/frigo_view.php';