<?php
<<<<<<< HEAD

session_start();

// Sécurité : on vérifie si l'utilisateur est connecté
if (!isset($_SESSION['compte_id'])) {
    header("Location: connexion_controller.php");
    exit();
}

// Tu récupères les données de session
$compte_id = $_SESSION['compte_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];



    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once __DIR__ . "/../models/db_connect.php";
    require_once __DIR__ . "/../models/openfooddata_connect.php";
    require_once __DIR__ . "/../models/accueil_model.php";
    $alertes = urgent();

    require_once __DIR__ . "/../views/accueil_view.php";

=======
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
>>>>>>> 9f8a6ad3295b736ed885ae371aaf1bd0baf618af
