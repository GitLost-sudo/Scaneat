<?php
$connexion = new PDO('mysql:host=localhost;dbname=ScanEat', 'root', '');

$message = "";
$type_message = ""; // "success" ou "error"

session_start();
$id_session = session_id();
$_SESSION["email"];
$_SESSION["password"];

if($id_session){
if (isset($_POST['valider'])) {

    if (!empty($_POST['email']) and !empty($_POST['password'])) { //si les champs e mail et mdp sont pas vide
        $email = htmlspecialchars($_POST['email']);// html special chars empeche a ce que le user mette des balises html 
        $password = $_POST['password'];//on définit mdp

        $req = $connexion->prepare("SELECT* FROM compte WHERE email=?");//sélectionner tout les colonnes de compte QUAND email = ce que lon tape
        $req->execute(array($email));//exécution de la requete avec le mail rentré
        $user = $req->fetch();// on associe un user à une requete

        if ($user && password_verify($password, $user['password'])) { // si ces correct on va mettre un petit formulaire la CACHE
            echo '
    <form id="redirectForm" action="../controllers/mon_profil_controller.php" method="POST">
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
}
?>