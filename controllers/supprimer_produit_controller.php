<?php
require_once __DIR__ . '/../models/supprimer_produit_frigo_model.php';
$error = null;
if($_SERVER['REQUEST_METHOD']=='GET')
{
    //Guard
    if(
        !isset($_GET['produit_id'])
        || !is_numeric($_GET['produit_id'])
    )
    {
        throw new Exception("Paramètres invalides");
    }
    supprimer_produit_frigo($_GET['$produit_id']);
    header('Location: /controllers/frigo_controller.php');
}