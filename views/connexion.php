<?php
$connexion = new PDO('mysql:host=localhost;dbname=ScanEat', 'root', '');

if (isset($_POST['valider'])) {

    if (!empty($_POST['email']) and !empty($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);// Protège contre les attaques XSS (injection de code HTML/JS) en transformant les caractères spéciaux en texte.
        $password = $_POST['password'];// on convertit pas
        $req = $connexion->prepare("SELECT* FROM compte WHERE email=?");
        $req->execute(array($email));
        $user = $req->fetch();
        if ($user && password_verify($password, $user['password'])) {
            echo "Le compte a bien été trouvé";

        } else
            echo "Le compte est introuvable";
    } else {
        echo "remplissez tout les champs";
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
                <img src="../img/home.png">
            </div>
        </header>
        <div class="titreInscription"> CONNEXION</div>
        <form action="" method="POST">
            <div class="BlocFormulaire">

                <div class="champ"> Email : <br>
                    <input type="text" name="email">
                </div>
                <div class="champ"> Mot de passe : <br>
                    <input type="password" name="password">
                </div>
                <div class="oublie">
                    <a href="">Mot de passe oublié ?</a>
                </div>


                <input type="submit" value="Se connecter" name="valider" class="ButtonCreation">

            </div>
        </form>
        <footer>
            <img src="../img/carotte2.png">
            <img src="../img/fromage2.png">
            <img src="../img/pomme2.png">
        </footer>
    </div>
</body>

</html>