<?php
$connexion = new PDO('mysql:host=localhost;dbname=ScanEat', 'root', '');

$message = "";
$type_message = "";

if (isset($_POST['valider'])) {
    if (!empty($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);//sert à protéger les données avant de les afficher dans une page HTML.
        $req = $connexion->prepare("SELECT compte_id FROM compte WHERE email = ?");
        $req->execute([$email]);
        $data = $req->fetch(); // ca sera un compte_id

        if ($data) {// data esrt le résultat de la requete
            $id = $data['compte_id'];// on précise [compte_id] lala pour éviter d'avoir toutes les colonnes du tableau
            // Générer un lien 
            $lien = "réinitialisation.php?id=" . urlencode($id);

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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
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
        <div class="TitreRecuperationMDP"> Email du compte que vous voulez récupérer :</div>
        <form action="" method="POST">
            <div class="BlocFormulaire">
                <div class="champ">
                    <input type="text" name="email">
                </div>
                <input type="submit" value="Envoyer" name="valider" class="ButtonCreation">

            </div>
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