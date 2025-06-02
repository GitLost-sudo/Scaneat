<?php


require_once __DIR__ . "/../models/db_connect.php";

$message = "";
$type_message = ""; // "success" ou "error"

if (isset($_POST['valider'])) {

    if (!empty($_POST['email']) and !empty($_POST['password'])) { //si les champs e mail et mdp sont pas vide
        $email = htmlspecialchars($_POST['email']);// html special chars empeche a ce que le user mette des balises html 
        $password = $_POST['password'];//on définit mdp

        $req = $db->prepare("SELECT* FROM compte WHERE email=?");//sélectionner tout les colonnes de compte QUAND email = ce que lon tape
        $req->execute(array($email));//exécution de la requete avec le mail rentré
        $user = $req->fetch();// on associe un user à une requete

        if ($user && password_verify($password, $user['password'])) { // si ces correct on va mettre un petit formulaire la CACHE
          
            $_SESSION['compte_id'] = $user['compte_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            
            echo '
    <form id="redirectForm" action="../controllers/accueil_controller.php" method="POST">
        <input type="hidden" name="email" value="' . htmlspecialchars($email) . '">
        <input type="hidden" name="password" value="' . htmlspecialchars($password) . '">
    </form>
    <script>
        document.getElementById("redirectForm").submit();
    </script>';

            exit();
        } else {
            $message = "Le compte est introuvable";
            $type_message = "error";
        }
    } else {
        $message = "Remplissez tout les champs";
        $type_message = "error";
    }
}

echo "compte trouvé";


?>