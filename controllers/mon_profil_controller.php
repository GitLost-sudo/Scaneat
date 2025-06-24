<?php
session_start();
//model
require_once __DIR__."/../models/user_model.php";

// Tu récupères les données de session
$compte_id = $_SESSION['compte_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
global $db;

// CHANGEMENT DE MOT DE PASSE
if (isset($_POST['actual_password'], $_POST['new_password'])) {
    if (!empty($_POST['actual_password']) && !empty($_POST['new_password'])) {
        $actual_password = $_POST['actual_password'];
        $new_password = $_POST['new_password'];
        $email = $_POST['email'];

        // Vérifie le mot de passe actuel
        $sql = "SELECT password, compte_id FROM compte WHERE email = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($actual_password, $user['password'])) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = "UPDATE compte SET password = ? WHERE compte_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$hashed_password, $user['compte_id']]);
            $message = "Mot de passe changé avec succès.";
            $type_message = "success";
        } else {
            $message = "Mot de passe actuel incorrect.";
            $type_message = "error";
        }
    } else {
        $message = "Veuillez remplir tous les champs pour changer le mot de passe.";
        $type_message = "error";
    }
}


// model

//var_dump($_POST);
require_once __DIR__ . "/../models/favoris_model.php";
require_once __DIR__ . "/../models/recette_model.php";

// traitement
$recettes = get_favoris_by_compte_id($compte_id);

// view
require_once __DIR__ . "/../views/mon_profil_view.php";