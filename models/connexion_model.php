<?php
$connexion = new PDO('mysql:host=localhost;dbname=ScanEat', 'root', '');

$message = "";
$type_message = ""; // "success" ou "error"

if (isset($_POST['valider'])) {

    if (!empty($_POST['email']) and !empty($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['password'];

        $req = $connexion->prepare("SELECT* FROM compte WHERE email=?");
        $req->execute(array($email));
        $user = $req->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $message = "Le compte a bien été trouvé";
            $type_message = "success";
        } else {
            $message = "Le compte est introuvable";
            $type_message = "error";
        }
    } else {
        $message = "Remplissez tout les champs";
        $type_message = "error";
    }
}
?>