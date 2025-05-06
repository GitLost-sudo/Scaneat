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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="../style.css" rel="stylesheet" />
</head>

<body>
    <div class="page-container">
        <header>
            <div class="logo">
                <img src="../img/ecriture.png">
            </div>
            <div class="home-icon">
                <a href="authentification.php">
                    <img src="../img/home.png">
                </a>
            </div>
        </header>
        <div class="titreInscription"> CONNEXION</div>
        <form action="" method="POST">


            <div class="champ"> Email : <br>
                <input type="text" name="email">
            </div>
            <div class="champ"> Mot de passe : <br>
                <input type="password" name="password">
            </div>
            <div class="oublie">
                <a href="recuperation.php">Mot de passe oublié ?</a>
            </div>
            <input type="submit" value="Se connecter" name="valider" class="ButtonCreation">
            <?php if (!empty($message)): ?>
                <div
                    style="text-align: center; color: <?= $type_message === 'success' ? 'green' : 'red' ?>; margin-top: 15px;">
                    <?= $message ?>
                </div>
            <?php endif; ?>

        </form>
        <footer>
            <img src="../img/carotte2.png">
            <img src="../img/fromage2.png">
            <img src="../img/pomme2.png">
        </footer>
    </div>
</body>

</html>