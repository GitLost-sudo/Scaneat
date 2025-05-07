<?php
require_once __DIR__."/../models/db_connect.php";
require_once __DIR__."/../models/openfooddata_connect.php";
require_once __DIR__."/../models/acceuil_model.php";
$alertes = urgent();
if($_SERVER['REQUEST_METHOD']=='GET')
{
    require_once __DIR__."/../views/acceuil_view.php";
}