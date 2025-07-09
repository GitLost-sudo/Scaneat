<?php
require_once __DIR__ . "/../models/db_connect.php";

$message = "";
$type_message = "";

if (isset($_POST['valider'])) {
    if (!empty($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);//sert à protéger les données avant de les afficher dans une page HTML.
        $req = $db->prepare("SELECT compte_id FROM compte WHERE email = ?");
        $req->execute([$email]);
        $data = $req->fetch(); // ca sera un compte_id

        if ($data) {// data esrt le résultat de la requete
            $id = $data['compte_id'];// on précise [compte_id] lala pour éviter d'avoir toutes les colonnes du tableau
            // Générer un lien 
            $lien = "https://scaneat.exp.esiea.fr/controllers/réinitialisation_controller.php?id=" . urlencode($id);

            $message = "Envoyé, <a href='$lien' style='color:green;'>cliquez ici pour réinitialiser votre mot de passe</a>";
            $type_message = "success";
        } else {
            $message = "Aucun compte trouvé avec cet email.";
            $type_message = "error";
        }
    } else {
        $message = "Veuillez entrer un email.";
        $type_message = "error";
    }
}
?>