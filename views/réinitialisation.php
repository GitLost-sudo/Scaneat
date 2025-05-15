<?php
$connexion = new PDO('mysql:host=localhost;dbname=ScanEat', 'root', '');
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
                $update = $connexion->prepare("UPDATE compte SET password = ? WHERE compte_id = ?");
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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau mot de passe</title>
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
        <form action="" method="POST">


            <div class="champ"> Nouveau Mot de Passe : <br>
                <input type="text" name="password">
            </div>
            <div class="champ"> Confirmation Mot de Passe: <br>
                <input type="password" name="confirmation">
            </div>

            <input type="submit" value="Changer" name="valider" class="ButtonCreation">
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