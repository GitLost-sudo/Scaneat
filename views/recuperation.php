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
                <a href="../controllers/authentification_controller.php">
                    <img src="../img/home.png">
                </a>
            </div>
        </header>
        <h1>
            <div class="titreInscription"> Email du compte que vous voulez récupérer :</div>
        </h1>
        <form action="../controllers/recuperation_controller.php" method="POST">

            <div class="BlocFormulaire">
                <div class="champ">
                    <input type="text" name="email">
                </div>
              
                    <input type="submit" value="Envoyer" name="valider" class="ButtonCreation">
                
            </div>
            <?php if (!empty($message)): ?>
                <div
                    style="text-align: center; color: <?= $type_message === 'success' ? 'green' : 'red' ?>; margin-top: 15px;">
                    <?= "Le lien à été envoyé avec succès" ?>
                </div>
            <?php endif; ?>

        </form>
  
    </div>
</body>

</html>