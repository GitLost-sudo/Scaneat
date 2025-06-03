<?php
require_once __DIR__ . "/../models/db_connect.php";
$message = "";
$type_message = "";

if (isset($_GET['id'])) { // Vérifie si LIDENTIFIANT est présent dans l'URL, c’est ce qui permet de savoir quel compte modifier
    $id=$_GET['id']; // ici on stock l'id dans une touuute petite variable

    if (isset($_POST['valider'])) { // Si On a cliqé sur valider
        $mdp = $_POST['password'];
        $confirmation = $_POST['confirmation'];

        if (!empty($mdp) && !empty($confirmation)) { // si cest pas vide en gros
            if ($mdp === $confirmation) {
                $hash = password_hash($mdp, PASSWORD_BCRYPT); //ivi on hash le mot de passe pour quil soit méconnaissable
                $update = $db->prepare("UPDATE compte SET password = ? WHERE compte_id = ?");
                $update->execute([$hash, $id]);

                $message = "Mot de passe modifié avec succès.";
                $type_message = "success";
            } else {
                $message = "Les mots de passe ne correspondent pas.";
                $type_message = "error";
            }
        } else {
            $message = "Veuillez remplir tous les champs.";
            $type_message = "error";
        }
    }
} else {
    $message = "Lien invalide.";
    $type_message = "error";
}
?>