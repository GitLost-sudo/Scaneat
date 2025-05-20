<?php
require_once __DIR__ . '/../models/supprimer_produit_frigo_model.php';
$error = null;
if($_SERVER['REQUEST_METHOD']=='GET')
{
    //Guard
    if (!isset($_GET['frigo_id']) || !is_numeric($_GET['frigo_id'])) {
        throw new Exception("Paramètres invalides");
    }
    
    $frigo_id = $_GET['frigo_id'];
    supprimer_produit_frigo($frigo_id);
    header('Location: ../views/frigo_view.php');
}
require_once __DIR__.'/../views/frigo_view.php';