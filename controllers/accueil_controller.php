<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__."/../models/db_connect.php";
require_once __DIR__."/../models/openfooddata_connect.php";
require_once __DIR__."/../models/accueil_model.php";

$alertes = urgent();
if($_SERVER['REQUEST_METHOD']=='GET')
{
    require_once __DIR__."/../views/accueil_view.php";
}